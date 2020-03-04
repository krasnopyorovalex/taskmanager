import {changeTimer, updateTasksTimeByInterval, updateTaskTimeByInterval} from "../../utils/utils";

document.addEventListener('DOMContentLoaded', () => {

    const tasks = document.querySelectorAll('.tasks-list .status');
    const task = document.querySelector('.aside-box .status');
    const filesBox = document.querySelector('.files-box');
    const requestToAction = document.getElementById('request-to-action');
    const requestToDestroyFile = document.getElementsByClassName('destroy-image');
    const btnLogout = document.getElementById('btn-logout');

    if (tasks.length) {
        const tasksLength = tasks.length;

        for (let i = 0; i < tasksLength; i++) {
            tasks[i].addEventListener("click", (event) => changeTimer(event, '/timer/change/'));
        }
    }

    if (task) {
        task.addEventListener("click", (event) => changeTimer(event, '/timer/change/'));
    }

    if (requestToAction) {
        requestToAction.addEventListener("click", (event) => {
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

    if (requestToDestroyFile) {
        const length = requestToDestroyFile.length;

        for (let i = 0; i < length; i++) {
            requestToDestroyFile[i].addEventListener("click", function (event) {
                const el = event.currentTarget;
                const url = el.getAttribute("data-url");

                if (confirm('Вы уверены?')) {
                    return window.axios.delete(url).then(function () {
                        return el.closest(".images-files-item").remove();
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                }
            });
        }
    }

    if (btnLogout) {
        btnLogout.addEventListener("click", function (event) {
            return event.currentTarget.querySelector('form').submit();
        });
    }

    updateTasksTimeByInterval();
    updateTaskTimeByInterval();
});
