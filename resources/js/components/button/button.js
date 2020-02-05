import React from 'react';

const Button = ({label}) => {
    return (
        <div className="editor_btn-box">
            <div className="btn btn-add">
                {label}
            </div>
        </div>
    );
};

export default Button;
