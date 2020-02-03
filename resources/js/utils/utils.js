export function changeTimer(event, endpoint) {
    const target = event.currentTarget;
    const uuid = target.getAttribute('data-uuid').toString();

    if (target.classList.contains('loading')) {
        return false;
    }
    target.classList.toggle('loading');

    return axios.get(endpoint + uuid)
        .then(function (response) {
            const { status, icon, label, time } = response.data;

            const classNames = target.className;
            const statusModified = status.toLowerCase();

            target.className = classNames.replace(/status_([a-z_]*)/, `status_${statusModified}`);

            target.querySelector('.status-value').innerText = label;

            target.querySelector('.svg-element').innerHTML = icon;

            target.closest('tr').querySelector('.time-value').innerHTML = time;
        })
        .catch(function (error) {
            // handle error
            console.log(error);
        })
        .then(function () {
            return target.classList.toggle('loading');
        });
}
