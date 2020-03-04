const INTERVAL_FOR_UPDATE = 600000;

export function changeTimer(event, endpoint) {
    const target = event.currentTarget;
    const uuid = target.getAttribute('data-uuid').toString();

    if (target.classList.contains('loading')) {
        return false;
    }
    target.classList.toggle('loading');

    return axios.get(endpoint + uuid)
        .then(function (response) {
            const { status, icon, label, time, performer } = response.data;

            const classNames = target.className;
            const statusModified = status.toLowerCase();

            target.className = classNames.replace(/status_([a-z_]*)/, `status_${statusModified}`);

            target.querySelector('.status-value').innerText = label;

            target.querySelector('.svg-icon').innerHTML = icon;

            const containerStatus = target.closest('tr') || target.closest('.aside-box');
            containerStatus.querySelector('.time-value').innerHTML = time;
            containerStatus.querySelector('.user').innerHTML = performer;
        })
        .catch(function ({response}) {
            if (response) {
                const message = response.data.message;
                notify(message);
            }
        })
        .then(function () {
            return target.classList.toggle('loading');
        });
}

export function updateTaskTimeByInterval() {
    const timeBox = document.querySelector('.time-box');

    if (timeBox) {
        setInterval(() => {
            return axios.get(`/timer/load-timer/${timeBox.getAttribute('data-key')}`)
                .then(function ({data}) {
                    return timeBox.querySelector(`[data-key='${data.key}'] .time-value`).innerHTML = data.time;
                });
        }, INTERVAL_FOR_UPDATE);
    }
}

export function updateTasksTimeByInterval() {

    const tasks = document.querySelector('.tasks-list');

    if (tasks) {
        setInterval(() => {
            return axios.get('/timer/load-timers')
                .then(function ({data}) {
                    for (let i = 0; i < data.length; i++) {
                        const task = data[i];
                        tasks.querySelector(`[data-key='${task.key}'] .time-value`).innerHTML = task.time;
                    }
                });
        }, INTERVAL_FOR_UPDATE);
    }
}

export function modifyCommentsArray(comments) {
    return comments ? comments.map((comment) => {
        comment.comments = comments.filter(({parent_id}) => parent_id === comment.id);

        return comment;
    }).filter(({parent_id}) => ! parent_id) : null;
}

export function notify(message) {
    const notification = document.getElementById('notify');

    if (notification) {
        notification.innerHTML = message;
        setTimeout(() => {
            notification.innerHTML = '';
        }, 5000);
    }
}
