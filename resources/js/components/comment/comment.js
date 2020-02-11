import React from 'react';
import Comments from "../comments";

const Comment = ({id, body, author, created_at, comments, replyTo}) => {

    const childComments = <Comments comments={comments} replyTo={replyTo} />;

    return (
        <li>
            <div className="comment-header with-icon">
                <div className="comment-header-user">
                    <div className="comment-header-user-img" dangerouslySetInnerHTML={{__html: '<svg><use xlink:href="../img/sprites/sprite.svg#icon-user"></use></svg>'}}>
                    </div>
                    <div className="comment-header-user-name">
                        {author}
                    </div>
                </div>
                <div className="comment-header-date">
                    {created_at}
                </div>
            </div>
            <div className="comment-body" dangerouslySetInnerHTML={{__html: body}}></div>
            <div className="comment-footer">
                <div className="btn-reply" onClick={() => replyTo(id)}>
                    Ответить
                </div>
            </div>
            {childComments}
        </li>
    );
};

export default Comment;
