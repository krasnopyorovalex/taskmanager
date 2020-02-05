export default class TaskmanagerService {
    getComments = (task) => {
        return axios.get(`/comments/${task}`);
    };
}
