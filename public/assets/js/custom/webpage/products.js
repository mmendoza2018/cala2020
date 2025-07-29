//const offCanvasShoppingCartProduct = new bootstrap.Offcanvas('#offCanvasShoppingCartProduct');

document.addEventListener("change", async (e) => {

    if (e.target.matches(".attributesProduct")) {
        console.log('(luismi):>> change');
        const selectedAttributes = getSelectedAttributes();
        let idProduct = document.querySelector(`[data-product_id]`).dataset.product_id;
        let formData = new FormData();

        formData.append("idProduct", idProduct)
        formData.append("selectedAttributes", JSON.stringify(selectedAttributes))

        try {
            let response = await customFetch(
                '/get_product_by_attributes',
                "POST",
                formData
            )

            if (response.status === "success") {
                console.log('response :>> ', response);
                let data = response.data;
                document.getElementById("originalPrice").textContent = `S/${(data.default_price)}`;
                document.getElementById("incrementedPrice").textContent = `S/${(data.default_price * 1.2).toFixed(2)}`;
                document.querySelector(`[data-default_product_attribute_id]`).dataset.default_product_attribute_id = data.id;

            } else {
                boxAlertValidation(response.errors);
                setTimeout(() => {
                    location.reload();
                }, 1000);
            }
        } catch (error) {
            console.error('Error de red:', error);
        }

    }
})

document.addEventListener('DOMContentLoaded', function () {
    console.log('(luismi):>> ahora si');
    if (document.querySelector(".splideProducts") !== null) {

        var main = new Splide('#main-carousel', {
            type: 'fade',
            rewind: true,
            pagination: false,
            arrows: false,
        });

        var thumbnails = new Splide('#thumbnail-carousel', {
            fixedWidth: 100,
            fixedHeight: 100,
            gap: 10,
            rewind: true,
            pagination: false,
            isNavigation: true,
            breakpoints: {
                600: {
                    fixedWidth: 60,
                    fixedHeight: 60,
                },
            },
        });

        main.sync(thumbnails);
        main.mount();
        thumbnails.mount();
    }

    obtenerProductosSession();
});

const obtenerProductosSession = async () => {
    let response = await customFetch(
        ROUTES.SHOPPING_CART_PRODUCTS + `/showCart`,
        "GET"
    )
    if (response.status === "success") {
        let data = response.data;
        console.log('(luismi): data :>> ', data);
        renderProductShoppingCart(data)
    }
}

/* funciones para ver los del carrito de compras */

const getShoppingCarts = async () => {
    try {
        let response = await customFetch(
            ROUTES.POS + `/showCart`,
        )
        if (response.status === "success") {
            let data = response.data;
            console.log('data :>> ', data);
            renderProductsCart(data);
        } else {
            boxAlertValidation(response.errors);
        }
    } catch (error) {
        console.error('Error de red:', error);
    }
}

const getSelectedAttributes = () => {

    const selectedAttributes = [];
    let selectsAttributes = document.querySelectorAll('.attributesProduct');
    selectsAttributes.forEach(select => {
        if (select.value !== "") {
            selectedAttributes.push(select.value);
        }
    });

    return selectedAttributes;

}
/* luismi */
const addProductToShoppingCart = async () => {

    try {
        let idProductAttribute = document.querySelector(`[data-default_product_attribute_id]`).dataset.default_product_attribute_id
        console.log('(luismi): idProductAttribute :>> ', idProductAttribute);
        let quantityProductCombination = document.getElementById("quantityProductCombination").value;
        console.log('(luismi):>> xddddddd');
        const formData = new FormData();

        formData.append("idProductAttribute", idProductAttribute);
        formData.append("quantity", quantityProductCombination);
        formData.append("type", "plus");

        let response = await customFetch(
            ROUTES.SHOPPING_CART_PRODUCTS + `/addRemoveProduct`,
            "POST",
            formData
        )
        if (response.status === "success") {
            toastAlert("!Producto Agregado!", "success", "bottom-start")
            let data = response.data;
            renderProductShoppingCartModal(data);

            document.querySelector(`[data-drawer-target="cartSidePenal"]`).click();
            //offCanvasShoppingCartProduct.show();
            $('.js-panel-cart').addClass('show-header-cart');
            //renderProductsCart(data);
        } else {
            toastAlert(response.errors, "warning");
        }
    } catch (error) {
        console.error('Error de red:', error);
    }

}
/* luismi */
const addRemoveProductToShoppingCart = async (element, type = "plus") => {
    try {

        let idProductAttribute = element.dataset.product_attribute_id
        const formData = new FormData();

        formData.append("idProductAttribute", idProductAttribute);
        formData.append("quantity", 1);
        formData.append("type", type);

        let response = await customFetch(
            ROUTES.SHOPPING_CART_PRODUCTS + `/addRemoveProduct`,
            "POST",
            formData
        )
        if (response.status === "success") {
            let data = response.data;
            toastAlert(type === "plus" ? "!Producto Agregado¡" : "!Producto Removido¡", "success", "bottom-start")
            renderProductShoppingCartModal(data);
            renderProductShoppingCart(data);
        } else {
            boxAlertValidation(response.errors);
        }
    } catch (error) {
        console.error('Error de red:', error);
    }

}

const renderProductShoppingCart = (data) => {
    const template = document.getElementById('templateProductShoppingCart');
    const container = document.querySelector('#containerShoppingCart');
    const baseUrl = document.querySelector('[data-base_url]').dataset.base_url;

    let total = 0;
    let subtotal = 0;

    container.innerHTML = '';

    if (Object.keys(data).length === 0) {
        container.innerHTML = `
        <tr>
            <td colspan="2">
                <div class="p-10 text-sm border text-center rounded-md text-slate-500 border-slate-200 bg-slate-50 dark:bg-zink-500/30 dark:border-zink-500 dark:text-zink-200">
                    <span class="font-bold">Aún no se añadieron productos a la orden</span>
                </div>
            </td>
        </tr>
        `;
    } else {
        Object.values(data).forEach(product => {
            const clone = template.content.cloneNode(true);

            const img = clone.querySelector('img');
            const titleLink = clone.querySelector('h6 a');
            const qualitySpans = clone.querySelectorAll('.fs-nine.text-sm.text-slate-500');
            const priceQtyText = clone.querySelector('p');
            const subtotalTd = clone.querySelector('td:last-child');

            const subtotalProduct = parseFloat(product.price * product.quantity).toFixed(2);

            // Set values
            img.src = `${baseUrl}/storage/uploads/${baseCodeCompany}/${product.image}`;
            img.alt = product.title;
            titleLink.textContent = `${product.title} | ${product.brand}`;
            titleLink.href = `productos/${product.slug}`;

            // Clear and fill attribute blocks (as "Calidad", "Color", etc.)
            qualitySpans.forEach(span => span.remove());

            const wrapper = clone.querySelector('.grow');

            product.attributes_combination.forEach(attribute => {
                const div = document.createElement('div');
                div.className = 'fs-nine text-sm text-slate-500 mb-1';
                div.style.lineHeight = '100%';

                div.innerHTML = `
                    <strong class="fs-nine fw_600" style="line-height: 110%">
                        ${attribute.attribute.attribute_group.description}:
                    </strong> ${attribute.attribute.description}
                `;

                wrapper.insertBefore(div, priceQtyText);
            });

            // Price and quantity text
            priceQtyText.textContent = `S/${product.price.toFixed(2)} x ${String(product.quantity).padStart(2, '0')}`;
            subtotalTd.textContent = `S/${subtotalProduct}`;

            subtotal += parseFloat(subtotalProduct);
            total = subtotal;

            container.appendChild(clone);
        });
    }

    document.querySelector("#detailsContainerShoppingCart .total").textContent = `S/ ${total.toFixed(2)}`;
};

const renderProductShoppingCartModal = (data) => {
    const template = document.getElementById('templateProductShoppingCartModal');
    const container = document.querySelector('#containerShoppingCartModal');
    let baseUrl = document.querySelector(`[data-base_url]`).dataset.base_url;
    let total = 0;
    let subtotal = 0;

    container.innerHTML = "";

    if (Object.keys(data).length === 0) {
        container.innerHTML = `<div class="p-10 text-sm border text-center rounded-md text-slate-500 border-slate-200 bg-slate-50 dark:bg-zink-500/30 dark:border-zink-500 dark:text-zink-200">
                    <span class="font-bold">Aun no se añadieron productos a la orden</span>
                </div>`;
        updateNumberProductsShoppingCart(0)
    } else {
        Object.values(data).forEach(product => {
            console.log('(luismi): product :>> ', product);
            // Clonamos el contenido del template
            const clone = template.content.cloneNode(true);
            let subtotalProduct = parseFloat(product.quantity * product.price).toFixed(2);
            // Asignamos los valores correspondientes
            clone.querySelector('.imgShoppingCartModal').src = `${baseUrl}/storage/uploads/${baseCodeCompany}/${product.image}`;
            clone.querySelector('.descriptionShoppingCartModal').textContent = `${product.title} | ${product.brand}`;
            clone.querySelector('.descriptionShoppingCartModal').parentNode.href = `${product.slug}`;
            clone.querySelector('.priceShoppingCartModal').textContent = `S/${product.price}`;
            clone.querySelector('.quantityShoppingCartModal').value = product.quantity;
            clone.querySelector('.subtotalShoppingCartModal').textContent = `S/ ${subtotalProduct}`;
            console.log('(luismi): product.price.toFixed(2) :>> ', product.price);
            // Asignamos los atributos dinámicamente
            const attributesList = clone.querySelector('.attributesShoppingCartModal');
            attributesList.innerHTML = ''; // Limpiamos la lista de atributos antes de añadir nuevos

            product.attributes_combination.forEach(attribute => {
                const div = document.createElement('div');
                div.classList.add('fs-nine');
                div.style.lineHeight = '100%';
                div.innerHTML = `<strong class="fs-nine fw_600" style="line-height: 110%">
                ${attribute.attribute.attribute_group.description}:</strong> ${attribute.attribute.description}`;
                attributesList.appendChild(div);
            });


            clone.querySelector('.minusBtnShoppingCartModal').dataset.product_attribute_id = product.productAttribute;
            clone.querySelector('.plusBtnShoppingCartModal').dataset.product_attribute_id = product.productAttribute;
            clone.querySelector('.removeBtnShoppingCartModal').dataset.product_attribute_id = product.productAttribute;

            subtotal += Number(subtotalProduct);
            total = subtotal;

            container.appendChild(clone);
        });

        updateNumberProductsShoppingCart(Object.values(data).length)
    }

    document.querySelector("#detailsContainerShoppingCartModal .totalShoppingCartModal").textContent = `S/ ${total.toFixed(2)}`;

}

const updateNumberProductsShoppingCart = (numProducts) => {
    document.querySelectorAll(`.numProductsShoppingCart`).forEach(element => {
        element.innerHTML = numProducts;
    });
}

const addRemoveProductCart = (element, type = "plus") => {
    if (type === "plus") {
        addProductShoppingCart(element)
    }
    if (type === "minus") {
        addProductShoppingCart(element, "minus")
    }
}

const addProductShoppingCart = async (element, type = "plus") => {

    try {

        let idProductAttribute = element.dataset.product_attribute_id

        const formData = new FormData();

        formData.append("idProductAttribute", idProductAttribute);
        formData.append("quantity", 1);
        formData.append("type", type);

        let response = await customFetch(
            ROUTES.SHOPPING_CART_PRODUCTS + `/addRemoveProduct`,
            "POST",
            formData
        )
        if (response.status === "success") {
            let data = response.data;
            renderProductShoppingCartModal(data);
            toastAlert("Producto agregado", "success", "bottom-start", 1000)
            if (document.getElementById("containerShoppingCart")) {
                renderProductShoppingCart(data);
            }
        } else {
            boxAlertValidation(response.errors);
        }
    } catch (error) {
        console.error('Error de red:', error);
    }

}


const removeProductShoppingCart = async (element) => {
    try {
        let idProductAttribute = element.dataset.product_attribute_id;
        let response = await customFetch(
            ROUTES.SHOPPING_CART_PRODUCTS + `/removeProduct/${idProductAttribute}`,
            "DELETE"
        )
        if (response.status === "success") {
            let data = response.data;
            renderProductShoppingCartModal(data);
            if (document.getElementById("containerShoppingCart")) {
                renderProductShoppingCart(data);
            }
        } else {
            boxAlertValidation(response.errors);
        }
    } catch (error) {
        console.error('Error de red:', error);
    }
}

/* Fin funciones para ver los del carrito de compras  */

$(document).on('click', '.pagination a', function (e) {

    e.preventDefault();
    const searchQuery = $('#searchInputQuery').val();
    const selectedOrder = $('#selectOrderQuery').val();
    const selectedBrands = [];
    $('.brand-checkbox:checked').each(function () {
        selectedBrands.push($(this).val());
    });
    let url = $(this).attr('href');

    $.ajax({
        url,
        data: {
            search: searchQuery,
            order: selectedOrder,
            brands: selectedBrands
        },
        success: function (data) {
            $('#productList').html(data);
        }
    });
});


$(document).ready(function () {
    // Manejar la búsqueda
    $('#searchBtnQuery').click(function (e) {
        e.preventDefault();
        fetchProducts();
        console.log('entre :>> ');
    });

    $('#inputFiltersProduct').on('input', function (e) {
        fetchProducts(null, null, true, true);
        console.log('entre :>> ');
    });

    // Manejar cambios en las marcas seleccionadas
    $(document).on('change', '.brand-checkbox, .category-checkbox, .subcategory-checkbox', function () {
        fetchProducts(null, null, true, true);
    });

    $(document).on('click', '.custom-tabs__buttons [data-filter_category_name]', function () {
        if (this.dataset.filter_category_name === "favorite") {
            fetchProducts(null, true, false, false);
        } else {
            let categoryId = this.dataset.filter_category_id;
            fetchProducts(categoryId, null, false, false);
        }
    });

    if (document.querySelector(`[data-page_active="home"]`)) {
        fetchProducts(null, true, false, false);
    }

    function fetchProducts(category = null, favorite = null, updateUrl = false, paginate = true) {
        const searchQuery = $('#searchInputQuery').val();
        const selectedOrder = document.getElementById("inputFiltersProduct")?.dataset?.value;
        let selectedBrands = [];
        let selectedCategories = [];
        let selectedSubCategories = [];
        let favorites = null;

        if (!category) {
            $('.category-checkbox:checked').each(function () {
                selectedCategories.push($(this).val());
            });
        } else {
            selectedCategories = [category];
        }

        $('.brand-checkbox:checked').each(function () {
            selectedBrands.push($(this).val());
        });

        $('.subcategory-checkbox:checked').each(function () {
            selectedSubCategories.push($(this).val());
        });

        if (!favorite) {
            favorites = $('#favorites').val();
        } else {
            favorites = favorite;
        }

        // Construir los parámetros GET
        const params = new URLSearchParams();
        if (searchQuery) params.append('search', searchQuery);
        if (selectedOrder) params.append('order', selectedOrder);
        if (favorites) params.append('favorites', favorites);
        if (paginate) params.append('paginate', paginate);
        selectedBrands.forEach(b => params.append('brands[]', b));
        selectedCategories.forEach(c => params.append('categories[]', c));
        selectedSubCategories.forEach(c => params.append('subcategories[]', c));

        const urlPath = window.location.pathname;
        const queryString = params.toString();
        const finalUrl = `${urlPath}?${queryString}`;

        // Condición: solo actualiza la URL si updateUrl es true
        if (updateUrl) {
            window.history.pushState({}, '', finalUrl);
        }

        // Petición AJAX
        $.ajax({
            url: finalUrl,
            type: 'GET',
            success: function (data) {
                $('#cardGridView').html(data);
            }
        });
    }

});


new Splide('#splideRelatedProducts', {
    type: 'loop',
    perPage: 5,
    autoplay: true,
    interval: 1000,
    gap: '2rem', // Espacio entre slides
    breakpoints: {
        768: {
            perPage: 1,
        },
    },
}).mount();