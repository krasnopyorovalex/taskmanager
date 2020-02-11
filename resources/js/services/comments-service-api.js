export default class CommentsServiceApi {
    getComments = (task) => {
        return axios.get(`/comments/${task}`);
    };

    saveComment = async (task, comment, replyTo) => {
        return await axios.post(`/comments/${task}`, {
            body: comment,
            parent_id: replyTo
        });
    };
}
