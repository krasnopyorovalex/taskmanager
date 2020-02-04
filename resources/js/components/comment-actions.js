import endpoints from "../endpoints";

export function getComments(task) {
    return axios.get(endpoints.getComments + task);
}
