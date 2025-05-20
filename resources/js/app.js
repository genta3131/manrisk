import flatpickr from "flatpickr";
import { Indonesian } from "flatpickr/dist/l10n/id.js";

import "flatpickr/dist/flatpickr.min.css";

document.addEventListener('DOMContentLoaded', function () {
    flatpickr("#identification_date_range", {
        mode: "range",
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "d F Y",
        locale: Indonesian,
        rangeSeparator: " s.d "
    });
});
