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
        .catch(function (error) {
            // handle error
            console.log(error);
        })
        .then(function () {
            return target.classList.toggle('loading');
        });
}
