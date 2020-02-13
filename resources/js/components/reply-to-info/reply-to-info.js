import React from 'react';

const ReplyToInfo = ({comments, replyTo, clearReply}) => {

    const findComment = comments.find((item) => {
        return item.id === replyTo;
    });

    return (
        <div className="reply-box">
            <div className="reply-to-info">
                {`Ответ на комментарий: ${findComment.author}`}
            </div>
            <div onClick={clearReply} className="clear-reply" dangerouslySetInnerHTML={{__html: '<svg><use xlink:href="../img/sprites/sprite.svg#icon-close-square"></use></svg>'}}></div>
        </div>
    );
};

export default ReplyToInfo;
