import React, { useState, useEffect, Fragment } from 'react';

import TaskmanagerService from "../../services/taskmanager-service";
import Comment from '../comment';
import Spinner from "../spinner";
import CommentsEditor from "../comments-editor";
import Button from "../button";

export default ({task}) => {

    const { getComments } = new TaskmanagerService();

    const [comments, setComments] = useState(null);
    const [comment, setComment] = useState('');

    useEffect(() => {
        getComments(task).then(function ({data}) {
            setComments(data);
        });
    },[]);

    if (! comments) {
        return <Spinner />;
    }

    console.log(comment);

    const items = comments.map((item) => {
        return (
            <Comment key={item.id} {...item} />
        );
    });

    return (
        <Fragment>
            <ul>
                {items}
            </ul>
            <CommentsEditor onChangedComment={(text) => setComment(text)} />
            <Button label="Добавить комментарий" />
        </Fragment>
    );
};
