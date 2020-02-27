import DatePicker from "../../vendor/datepicker";

document.addEventListener('DOMContentLoaded', () => {

    const filterForm = document.querySelector('.filter-form');
    if (filterForm) {

        new DatePicker({
            id: 'f-started-at',
            dateFormat: 'yyyy-MM-dd',
            maxDate: 0
        });

        new DatePicker({
            id: 'f-stop-at',
            dateFormat: 'yyyy-MM-dd',
            maxDate: 0
        });
    }
});
