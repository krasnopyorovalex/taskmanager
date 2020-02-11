import React from 'react';

import Comment from '../comment';

const Comments = ({comments, replyTo}) => {

    const items = comments.map((item) => {
        return <Comment key={item.id} {...item} replyTo={replyTo} />;
    });

    return (
        items.length
            ? <ul>{items}</ul>
            : ''
    );
};

export default Comments;
