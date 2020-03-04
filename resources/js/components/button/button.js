import React from 'react';

const Button = ({label, onEventSave}) => {

    return (
        <div className="editor_btn-box">
            <div className="btn btn-add" onClick={onEventSave}>
                {label}
            </div>
        </div>
    );
};

export default Button;
