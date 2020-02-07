import React from 'react';

import Comment from '../comment';
import Spinner from "../spinner";

const Comments = ({comments}) => {

    if (! comments) {
        return <Spinner />;
    }

    const items = comments.map((item) => {
        return <Comment key={item.id} {...item} />;
    });

    return (
        <ul>
            {items}
        </ul>
    );
};

export default Comments;
