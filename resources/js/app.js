import './bootstrap';
import "@fontsource/poppins";

// import js files
import './change-password';
import './login';
import './password-toggle';
import './admin/admin-categories';
import './admin/admin-products';
import './admin/admin-sidebar';
import './admin/user';
import './cashier/cashier-header';
import './cashier/cashier-order';
import './cashier/orders';
import './inventory/inventory-categories';
import './inventory/inventory-items';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
