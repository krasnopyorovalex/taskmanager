import DatePicker from "../../vendor/datepicker";
import {notify} from "../../utils/utils";

document.addEventListener('DOMContentLoaded', () => {

    new DatePicker({
        id: 'datepicker',
        dateFormat: 'yyyy-MM-dd',
        minDate: 1
    });

    const datepickerEdit = document.getElementById('datepicker-edit');

    if (datepickerEdit) {
        const editDatepicker = new DatePicker({
            id: 'deadline',
            dateFormat: 'yyyy-MM-dd',
            minDate: 1,
            callback: () => {
                return axios.post(document.getElementById('deadline').closest('form').getAttribute('action'), {
                    deadline: datepickerEdit.querySelector('input[name=deadline]').value
                }).then(({data}) => {
                    datepickerEdit.querySelector('.deadline-value').innerText = data.deadline;
                    return notify(data.message);
                }).catch(function ({response}) {
                    if (response) {
                        const message = response.data.message;
                        notify(message);
                    }
                });
            }
        });

        datepickerEdit.addEventListener('click', function () {
            return editDatepicker.showPicker();
        });
    }
});
