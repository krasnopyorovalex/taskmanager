export default class CommentsServiceApi {
    getComments = (url) => {
        return axios.get(url);
    };

    saveComment = async (url, comment, replyTo) => {
        return await axios.post(url, {
            body: comment,
            parent_id: replyTo
        });
    };
}
