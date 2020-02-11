import React from 'react';

const ReplyToInfo = ({comments, replyTo}) => {

    const findComment = comments.find((item) => {
        return item.id === replyTo;
    });

    return (
        <div className="reply-to-info">
            {`Ответ на комментарий: ${findComment.author}`}
        </div>
    );
};

export default ReplyToInfo;
