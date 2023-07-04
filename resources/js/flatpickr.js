// https://flatpickr.js.org/getting-started/ よりコピペ

import flatpickr from "flatpickr";

// import { Japanese } from "flatpickr/dist/l10n/ja.js"

// flatpickr(myElem, {
//     "locale": Japanese
// });

flatpickr("#reserve_date", {
    // "locale": Japanese,
    minDate: "today",
    maxDate: new Date().fp_incr(30) // 14 days from now
});

flatpickr("#calendar", {
    // "locale": Japanese,
    // minDate: "today",
    maxDate: new Date().fp_incr(30) // 14 days from now
});

const setting = {
    // "locale": Japanese,
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    time_24hr: true,
    minTime: "10:00",
    maxTime: "18:00",
}

flatpickr("#start_time", setting);

flatpickr("#end_time", setting);
