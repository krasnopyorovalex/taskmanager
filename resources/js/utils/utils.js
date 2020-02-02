export function changeTimer(event, endpoint) {
    const target = event.currentTarget;
    const uuid = target.getAttribute('data-uuid').toString();

    return axios.get(endpoint + uuid);
}
