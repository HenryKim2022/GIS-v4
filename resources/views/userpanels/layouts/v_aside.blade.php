<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('dashboard.page') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <span style="color: var(--bs-primary)">
                    <svg width="268" height="150" viewBox="0 0 38 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M30.0944 2.22569C29.0511 0.444187 26.7508 -0.172113 24.9566 0.849138C23.1623 1.87039 22.5536 4.14247 23.5969 5.92397L30.5368 17.7743C31.5801 19.5558 33.8804 20.1721 35.6746 19.1509C37.4689 18.1296 38.0776 15.8575 37.0343 14.076L30.0944 2.22569Z"
                            fill="currentColor" />
                        <path
                            d="M30.171 2.22569C29.1277 0.444187 26.8274 -0.172113 25.0332 0.849138C23.2389 1.87039 22.6302 4.14247 23.6735 5.92397L30.6134 17.7743C31.6567 19.5558 33.957 20.1721 35.7512 19.1509C37.5455 18.1296 38.1542 15.8575 37.1109 14.076L30.171 2.22569Z"
                            fill="url(#paint0_linear_2989_100980)" fill-opacity="0.4" />
                        <path
                            d="M22.9676 2.22569C24.0109 0.444187 26.3112 -0.172113 28.1054 0.849138C29.8996 1.87039 30.5084 4.14247 29.4651 5.92397L22.5251 17.7743C21.4818 19.5558 19.1816 20.1721 17.3873 19.1509C15.5931 18.1296 14.9843 15.8575 16.0276 14.076L22.9676 2.22569Z"
                            fill="currentColor" />
                        <path
                            d="M14.9558 2.22569C13.9125 0.444187 11.6122 -0.172113 9.818 0.849138C8.02377 1.87039 7.41502 4.14247 8.45833 5.92397L15.3983 17.7743C16.4416 19.5558 18.7418 20.1721 20.5361 19.1509C22.3303 18.1296 22.9391 15.8575 21.8958 14.076L14.9558 2.22569Z"
                            fill="currentColor" />
                        <path
                            d="M14.9558 2.22569C13.9125 0.444187 11.6122 -0.172113 9.818 0.849138C8.02377 1.87039 7.41502 4.14247 8.45833 5.92397L15.3983 17.7743C16.4416 19.5558 18.7418 20.1721 20.5361 19.1509C22.3303 18.1296 22.9391 15.8575 21.8958 14.076L14.9558 2.22569Z"
                            fill="url(#paint1_linear_2989_100980)" fill-opacity="0.4" />
                        <path
                            d="M7.82901 2.22569C8.87231 0.444187 11.1726 -0.172113 12.9668 0.849138C14.7611 1.87039 15.3698 4.14247 14.3265 5.92397L7.38656 17.7743C6.34325 19.5558 4.04298 20.1721 2.24875 19.1509C0.454514 18.1296 -0.154233 15.8575 0.88907 14.076L7.82901 2.22569Z"
                            fill="currentColor" />
                        <defs>
                            <linearGradient id="paint0_linear_2989_100980" x1="5.36642" y1="0.849138" x2="10.532"
                                y2="24.104" gradientUnits="userSpaceOnUse">
                                <stop offset="0" stop-opacity="1" />
                                <stop offset="1" stop-opacity="0" />
                            </linearGradient>
                            <linearGradient id="paint1_linear_2989_100980" x1="5.19475" y1="0.849139" x2="10.3357"
                                y2="24.1155" gradientUnits="userSpaceOnUse">
                                <stop offset="0" stop-opacity="1" />
                                <stop offset="1" stop-opacity="0" />
                            </linearGradient>
                        </defs>
                    </svg>
                </span>
            </span>
            <span class="app-brand-text demo menu-text fw-bold ms-2">{{ env('APP_NAME') }}</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M11.4854 4.88844C11.0081 4.41121 10.2344 4.41121 9.75715 4.88844L4.51028 10.1353C4.03297 10.6126 4.03297 11.3865 4.51028 11.8638L9.75715 17.1107C10.2344 17.5879 11.0081 17.5879 11.4854 17.1107C11.9626 16.6334 11.9626 15.8597 11.4854 15.3824L7.96672 11.8638C7.48942 11.3865 7.48942 10.6126 7.96672 10.1353L11.4854 6.61667C11.9626 6.13943 11.9626 5.36568 11.4854 4.88844Z"
                    fill="currentColor" fill-opacity="0.6" />
                <path
                    d="M15.8683 4.88844L10.6214 10.1353C10.1441 10.6126 10.1441 11.3865 10.6214 11.8638L15.8683 17.1107C16.3455 17.5879 17.1192 17.5879 17.5965 17.1107C18.0737 16.6334 18.0737 15.8597 17.5965 15.3824L14.0778 11.8638C13.6005 11.3865 13.6005 10.6126 14.0778 10.1353L17.5965 6.61667C18.0737 6.13943 18.0737 5.36568 17.5965 4.88844C17.1192 4.41121 16.3455 4.41121 15.8683 4.88844Z"
                    fill="currentColor" fill-opacity="0.38" />
            </svg>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item">
            <a href="{{ route('dashboard.page') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
                <div data-i18n="Dashboards">Dashboards</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('landing.page') }}" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-airplane-landing"></i>
                <div data-i18n="Landing Page">Landing Page</div>
            </a>
        </li>


        <!-- Apps & Pages -->
        <li class="menu-header fw-medium mt-4">
            <span class="menu-header-text" data-i18n="DB Managements">DB Managements</span>
        </li>
        <!-- manage-maps menu start -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons mdi mdi-leaf-maple"></i>
                <div data-i18n="Manage Maps">Manage Maps</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <div data-i18n="Institutions">Institutions</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{ route('m-categories.index') }}" class="menu-link">
                                <i class="menu-icon tf-icons mdi mdi-factory"></i>
                                <div data-i18n="Categories"> Categories</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('m-institutions') }}" class="menu-link">
                                <i class="menu-icon tf-icons mdi mdi-clipboard-list-outline"></i>
                                <div data-i18n="List"> List</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="menu-item">
                    <a href="{{ route('m-markings.index') }}" class="menu-link">
                        <div data-i18n="Marking List">Marking List</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- manage-maps menu end -->





        <!-- user-account menu start -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons mdi mdi-account-group-outline"></i>
                <div data-i18n="User Accounts">User Accounts</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('m-ul.index') }}" class="menu-link">
                        <div data-i18n="User List">User List</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- user-account menu end -->

        <!-- Misc -->
        <li class="menu-header fw-medium mt-4">
            <span class="menu-header-text" data-i18n="Misc">Misc</span>
        </li>
        <li class="menu-item" data-bs-toggle="modal" data-bs-target="#aboutUsModal">
            <a href="javascript:void(0);" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-slack"></i>
                <div data-i18n="About">About</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link" id="supportSideMenu"
                onclick='showAlert(this.id, "System", "info", "Sorry, support not available :(")'>
                <i class="menu-icon tf-icons mdi mdi-lifebuoy"></i>
                <div data-i18n="Support">Support</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link" id="docSideMenu"
                onclick='showAlert(this.id, "System", "info", "Sorry, documentations not available :(")'>
                <i class="menu-icon tf-icons mdi mdi-file-document-multiple-outline"></i>
                <div data-i18n="Documentation">Documentation</div>
            </a>
        </li>
    </ul>




    <script>
        // GIVING CLASS ACTIVE TO CURRENT ACTIVE PAGE --> ASIDE MENU
        // Get the current URL
        var currentUrl = window.location.href;
        // Get all menu items
        var menuItems = document.querySelectorAll('.menu-item');

        // Loop through each menu item and check if the href matches
        for (var i = 0; i < menuItems.length; i++) {
            var menuItem = menuItems[i];
            var menuLink = menuItem.querySelector('.menu-link');

            // If the href matches the current URL, add the 'active' class
            if (menuLink && menuLink.getAttribute('href') === currentUrl) {
                menuItem.classList.add('active');

                // If there is a submenu, also add the 'active' class to the submenu's parent menu item
                var submenu = menuItem.querySelector('.menu-sub');
                if (submenu) {
                    submenu.parentNode.classList.add('active');
                }
            }
        }
    </script>

    <script>
        // GIVING CLASS OPEN TO CURRENT ACTIVE MENU --> ASIDE MENU
        // Get all parent menu items that have a submenu
        var parentMenuItems = document.querySelectorAll('.menu-item > .menu-link.menu-toggle');

        // Loop through each parent menu item
        for (var i = 0; i < parentMenuItems.length; i++) {
            var parentMenuItem = parentMenuItems[i].closest('.menu-item');

            // Check if any of the parent menu item's children have the 'active' class
            var hasActiveChild = parentMenuItem.querySelector('.menu-item.active');

            // Add the 'open' class to the parent menu item if it has an active child or the submenu item itself is open
            if (hasActiveChild || parentMenuItem.classList.contains('open')) {
                parentMenuItem.classList.add('open');
            }
        }
    </script>

    <script>
        // GIVING CLASS ACTIVE TO CURRENT PARENTMENUITEMS AFTER GIVEN CLASS OPEN by LAST JS --> ASIDE MENU
        // Get all parent menu items that have a submenu
        var parentMenuItems = document.querySelectorAll('.menu-item > .menu-link.menu-toggle');

        // Loop through each parent menu item
        for (var i = 0; i < parentMenuItems.length; i++) {
            var parentMenuItem = parentMenuItems[i].closest('.menu-item');

            // Check if the parent menu item has the 'open' class
            if (parentMenuItem.classList.contains('open')) {
                parentMenuItem.classList.add('active');
            }
        }
    </script>

</aside>
