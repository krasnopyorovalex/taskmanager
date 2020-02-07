import React from 'react';
import Comments from "../comments";

const Comment = ({body, user, created_at, comments}) => {

    const newBranchComments = <Comments comments={comments} />;

    return (
        <li>
            <div className="comment-header with-icon">
                <div className="comment-header-user">
                    <div className="comment-header-user-img" dangerouslySetInnerHTML={{__html: '<svg><use xlink:href="../img/sprites/sprite.svg#icon-user"></use></svg>'}}>
                    </div>
                    <div className="comment-header-user-name">
                        {user}
                    </div>
                </div>
                <div className="comment-header-date">
                    {created_at}
                </div>
            </div>
            <div className="comment-body" dangerouslySetInnerHTML={{__html: body}}></div>
            <div className="comment-footer">
                <div className="btn-reply">
                    Ответить
                </div>
            </div>
            {newBranchComments}
        </li>
    );
};

export default Comment;
