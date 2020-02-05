import ReactDOM from "react-dom";
import React from "react";

import Comments from './components/comments';

const el = document.getElementById('comments');

if (document.getElementById('comments')) {
    ReactDOM.render(<Comments task={el.getAttribute('data-task')} />, el);
}
