import React, {useState, useRef} from 'react';
import JoditEditor from "jodit-react";

const CommentsEditor = ({}) => {
    const editor = useRef(null);
    const [content, setContent] = useState('');

    const config = {
        readonly: false, // all options from https://xdsoft.net/jodit/doc/
        showPlaceholder: false,
        showXPathInStatusbar: false,
        showWordsCounter: false,
        showCharsCounter: false,
        minHeight: '180',
        removeButtons: [
            'font', 'fontsize', 'copyformat', 'paragraph', 'brush', 'fullsize', 'video', 'file', 'indent', 'left',
            'paste', 'copy', 'cut', 'selectall', 'break', 'outdent', 'subscript', 'superscript', 'symbol', 'print', 'about'
        ]
    };

    return (
        <JoditEditor
            ref={editor}
            value={content}
            config={config}
            tabIndex={1} // tabIndex of textarea
            onBlur={newContent => setContent(newContent)} // preferred to use only this option to update the content for performance reasons
            onChange={newContent => {}}
        />
    );
};

export default CommentsEditor;
