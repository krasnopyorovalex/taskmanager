import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';

import Li from './li';
import { getComments } from "../comment-actions";

const App = ({task}) => {

    const [comments, setComments] = useState(null);

    useEffect(() => {
        getComments(task).then(function ({data}) {
            setComments(data);
        });
    },[]);

    if (! comments) {
        return false;
    }

    const items = comments.map((item) => {
        return (
            <Li key={item.id} {...item} />
        );
    });

    return (<ul>{items}</ul>);
};

const el = document.getElementById('comments');

if (document.getElementById('comments')) {
    ReactDOM.render(<App task={el.getAttribute('data-task')} />, el);
}
