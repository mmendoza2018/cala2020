<div>
    <ul class="group-data-[layout=horizontal]:flex group-data-[layout=horizontal]:flex-col group-data-[layout=horizontal]:md:flex-row"
        id="navbar-nav">

        <x-side-li-main description="MODULOS" />

        <x-side-li-menu description="Administración">

            <x-side-li-submenu2 description="Dashboards">
                <x-side-li-submenu description="Ventas" data-side_key="dashboard_view_sale"  url="dashboard.view_sale" />
                <x-side-li-submenu description="Usuarios" data-side_key="dashboard_view_user"  url="dashboard.view_user" />
            </x-side-li-menu2>

            <x-side-li-submenu2 description="Productos">
                <x-side-li-submenu description="Registro" data-side_key="product_create"  url="product.create" />
                <x-side-li-submenu description="Historial" data-side_key="product_index" url="product.index" />
            </x-side-li-menu2>

            <x-side-li-submenu2 description="Banners">
                <x-side-li-submenu description="Registro" data-side_key="product_create"  url="product.create" />
                <x-side-li-submenu description="Historial" data-side_key="product_index" url="product.index" />
            </x-side-li-menu2>

            <x-side-li-submenu2 description="Promociones">
                <x-side-li-submenu description="Registro" data-side_key="product_create"  url="product.create" />
                <x-side-li-submenu description="Historial" data-side_key="product_index" url="product.index" />
            </x-side-li-menu2>

            {{-- <x-side-li-submenu2 description="clientes">
                <x-side-li-submenu description="Historial" data-side_key="users_index" url="users.index" />
            </x-side-li-menu2> --}}

            <x-side-li-submenu2 description="Paginas">
                <x-side-li-submenu description="Politicas de privacidad" data-side_key="users_index" url="users.index" />
                <x-side-li-submenu description="Políticas de reeembolso" data-side_key="users_index" url="users.index" />
                <x-side-li-submenu description="Términos y condiciones" data-side_key="users_index" url="users.index" />
            </x-side-li-menu2>

            <x-side-li-submenu2 description="Ventas">
                <x-side-li-submenu description="Historial" data-side_key="orders_index" url="orders.index" />
            </x-side-li-menu2>

            <x-side-li-submenu2 description="Reclamaciones">
                <x-side-li-submenu description="Historial" data-side_key="complaint_book_index" url="complaint_book.index" />
            </x-side-li-menu2>

        </x-side-li-menu>

        <x-side-li-main description="MANTENIMIENTOS" />

        <x-side-li-menu description="Configuración del sistema">

            <x-side-li-submenu description="Categorias Productos" data-side_key="product_category_index" url="product_category.index" />
            <x-side-li-submenu description="Marcas Productos" data-side_key="product_brand_index" url="product_brand.index" />
            <x-side-li-submenu description="Variantes de Productos" data-side_key="attribute_group_index" url="attribute_group.index" />

        </x-side-li-menu>
    </ul>
</div>
