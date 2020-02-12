import {changeTimer} from "../../utils/utils";

document.addEventListener('DOMContentLoaded', () => {

    const tasks = document.querySelectorAll('.tasks-list .status');
    const task = document.querySelector('.aside-box .status');
    const filesBox = document.querySelector('.files-box');
    const requestToComplete = document.getElementById('request-to-complete');

    if (tasks.length) {
        const tasksLength = tasks.length;

        for (let i = 0; i < tasksLength; i++) {
            tasks[i].addEventListener("click", (event) => changeTimer(event, '/timer/change/'));
        }
    }

    if (task) {
        task.addEventListener("click", (event) => changeTimer(event, '/timer/change/'));
    }

    if (requestToComplete) {
        requestToComplete.addEventListener("click", (event) => {
            if (confirm('Вы уверены?')) {
                return event.currentTarget.querySelector("form").submit();
            }
        });
    }

    if (filesBox) {
        filesBox.querySelector('.add-files-btn').addEventListener("click", function () {
            return filesBox.querySelector('input[type=file]').click();
        });

        filesBox.querySelector('form').addEventListener("change", function (event) {
            return event.currentTarget.submit();
        });
    }
});
