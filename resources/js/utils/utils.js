//const INTERVAL_FOR_UPDATE = 600000;

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

// export function updateTimeByInterval() {
//     const times = document.getElementsByClassName('time');
//     if (times) {
//         const timesLength = times.length;
//         setInterval(() => {
//             for (let i = 0; i < timesLength; i++) {
//                 const total = parseInt(times[i].getAttribute('data-total'));
//
//                 times[i].setAttribute('data-total', (total + INTERVAL_FOR_UPDATE/1000).toString());
//                 times[i].querySelector('.time-value').innerHTML = parseSeconds(total);
//             }
//         }, INTERVAL_FOR_UPDATE);
//     }
// }
//
// export function parseSeconds(seconds) {
//
//     seconds += INTERVAL_FOR_UPDATE/1000;
//
//     const hours = Math.floor(seconds / 3600);
//     const minutes = Math.floor(seconds % 3600 / 60);
//
//     return hours ? `${hours}<span>ч</span> ${minutes}<span>мин</span>` : `${minutes}<span>мин</span>`;
// }

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
