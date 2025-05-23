//const offCanvasShoppingCartProduct = new bootstrap.Offcanvas('#offCanvasShoppingCartProduct');

document.addEventListener("change", async (e) => {

    if (e.target.matches(".attributesProduct")) {

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
});

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
        let quantityProductCombination = document.getElementById("quantityProductCombination").value;

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
            let data = response.data;
            console.log('data :>> ', data);
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
            console.log('data :>> ', data);
            renderProductShoppingCartModal(data);
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
    let baseUrl = document.querySelector(`[data-base_url]`).dataset.base_url;
    let total = 0;
    let subtotal = 0;

    container.innerHTML = "";

    if (Object.keys(data).length === 0) {
        container.innerHTML = `
        <div class="p-10 text-sm border text-center rounded-md text-slate-500 border-slate-200 bg-slate-50 dark:bg-zink-500/30 dark:border-zink-500 dark:text-zink-200">
                    <span class="font-bold">Aun no se añadieron productos a la orden</span>
                </div>
        `;
    } else {
        Object.values(data).forEach(product => {
            // Clonamos el contenido del template
            const clone = template.content.cloneNode(true);
            let subtotalProduct = parseFloat(product.quantity * product.price).toFixed(2);

            // Asignamos los valores correspondientes
            clone.querySelector('.imgShoppingCart').src = `${baseUrl}/storage/uploads/${product.image.path}`;
            clone.querySelector('.descriptionShoppingCart').textContent = `${product.title} | ${product.brand}`;
            clone.querySelector('.priceShoppingCart').textContent = `S/${product.price.toFixed(2)}`;
            clone.querySelector('.quantityShoppingCart').value = product.quantity;
            clone.querySelector('.subtotalShoppingCart').textContent = subtotalProduct;

            // Asignamos los atributos dinámicamente
            const attributesList = clone.querySelector('.attributesShoppingCart');
            attributesList.innerHTML = ''; // Limpiamos la lista de atributos antes de añadir nuevos
            {/* <span class="fw_600 n3-clr d-block mb-0" style="line-height: 110%;">
</span> */}
            product.attributes_combination.forEach(attribute => {
                const span = document.createElement('span');
                span.classList.add('fw_600', 'n3-clr', 'd-block', 'mb-0');
                span.style.lineHeight = '100%';
                span.innerHTML = `${attribute.attribute.attribute_group.description}:  ${attribute.attribute.description}`;
                attributesList.appendChild(span);
            });

            clone.querySelector('.minusBtnShoppingCart').dataset.product_attribute_id = product.productAttribute;
            clone.querySelector('.plusBtnShoppingCart').dataset.product_attribute_id = product.productAttribute;
            clone.querySelector('.removeBtnShoppingCart').dataset.product_attribute_id = product.productAttribute;

            subtotal += Number(subtotalProduct);
            total = subtotal;

            container.appendChild(clone);
        });
    }

    document.querySelector("#detailsContainerShoppingCart .numProducts").textContent = Object.values(data).length;
    document.querySelector("#detailsContainerShoppingCart .subtotal").textContent = subtotal.toFixed(2);
    document.querySelector("#detailsContainerShoppingCart .total").textContent = total.toFixed(2);

}

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
            // Clonamos el contenido del template
            const clone = template.content.cloneNode(true);
            let subtotalProduct = parseFloat(product.quantity * product.price).toFixed(2);
            // Asignamos los valores correspondientes
            clone.querySelector('.imgShoppingCartModal').src = `${baseUrl}/storage/uploads/${product.image}`;
            clone.querySelector('.descriptionShoppingCartModal').textContent = `${product.title} | ${product.brand}`;
            clone.querySelector('.priceShoppingCartModal').textContent = `S/${product.price.toFixed(2)}`;
            clone.querySelector('.quantityShoppingCartModal').value = product.quantity;
            clone.querySelector('.subtotalShoppingCartModal').textContent = subtotalProduct;

            // Asignamos los atributos dinámicamente
            const attributesList = clone.querySelector('.attributesShoppingCartModal');
            attributesList.innerHTML = ''; // Limpiamos la lista de atributos antes de añadir nuevos

            product.attributes_combination.forEach(attribute => {
                const li = document.createElement('li');
                li.classList.add('fs-nine');
                li.style.lineHeight = '100%';
                li.innerHTML = `<span class="fs-nine fw_600" style="line-height: 110%">${attribute.attribute.attribute_group.description}:</span> ${attribute.attribute.description}`;
                attributesList.appendChild(li);
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

    document.querySelector("#detailsContainerShoppingCartModal .totalShoppingCartModal").textContent = total.toFixed(2);

}

const updateNumberProductsShoppingCart = (numProducts) => {
    document.getElementById(`numProductsShoppingCart`).innerHTML = numProducts;
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

    // Manejar cambios en el select de ordenamiento
    $('#selectOrderQuery').change(function () {
        fetchProducts();
    });

    // Manejar cambios en las marcas seleccionadas
    $(document).on('change', '.brand-checkbox', function () {
        fetchProducts();
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

    function fetchProducts(category = null, favorite = null, updateUrl = false, paginate=true) {
        const searchQuery = $('#searchInputQuery').val();
        const selectedOrder = $('#selectOrderQuery').val();
        let selectedBrands = [];
        let selectedCategories = [];
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