import React, {Component, Fragment} from 'react';
import {Editor, EditorState, RichUtils} from 'draft-js';
import BlockStyleControls from "./block-style-controls";
import InlineStyleControls from "./inline-style-controls"

import {stateToHTML} from 'draft-js-export-html';
import Button from "../button";

class CommentsEditor extends Component {

    state = {
        commentBody: null
    };

    constructor(props) {
        super(props);
        this.state = {editorState: EditorState.createEmpty()};

        this.focus = () => this.refs.editor.focus();
        this.onChange = (editorState) => this.setState({editorState});

        this.handleKeyCommand = (command) => this._handleKeyCommand(command);
        this.toggleBlockType = (type) => this._toggleBlockType(type);
        this.toggleInlineStyle = (style) => this._toggleInlineStyle(style);
    }

    componentDidUpdate(prevProps, prevState, snapshot) {
        const {editorState} = this.state;

        if (this.props.clearEditor) {
            this.props.toggleClearEditor();
            this.setState({editorState: EditorState.createEmpty()});
        }

        if (prevState.editorState !== editorState) {
            this.setState({
                commentBody: stateToHTML(editorState.getCurrentContent())
            });
        }
    }

    _handleKeyCommand(command) {
        const {editorState} = this.state;
        const newState = RichUtils.handleKeyCommand(editorState, command);
        if (newState) {
            this.onChange(newState);
            return true;
        }
        return false;
    }

    _toggleBlockType(blockType) {
        this.onChange(
            RichUtils.toggleBlockType(
                this.state.editorState,
                blockType
            )
        );
    }

    _toggleInlineStyle(inlineStyle) {
        this.onChange(
            RichUtils.toggleInlineStyle(
                this.state.editorState,
                inlineStyle
            )
        );
    }

    render() {
        const { editorState } = this.state;

        const { saveComment } = this.props;

        return (
            <Fragment>
                <div className="rich-editor-root">
                    <div className="toolbar">
                        <InlineStyleControls
                            editorState={editorState}
                            onToggle={this.toggleInlineStyle}
                        />
                        <BlockStyleControls
                            editorState={editorState}
                            onToggle={this.toggleBlockType}
                        />
                    </div>
                    <div className="rich-editor-editor" onClick={this.focus}>
                        <Editor
                            blockStyleFn={getBlockStyle}
                            editorState={editorState}
                            handleKeyCommand={this.handleKeyCommand}
                            onChange={this.onChange}
                            placeholder=""
                            ref="editor"
                            spellCheck={true}
                        />
                    </div>
                </div>
                <Button label="Добавить комментарий" onEventSave={() => saveComment(this.state.commentBody)} />
            </Fragment>
        );
    }
}

function getBlockStyle(block) {
    switch (block.getType()) {
        case 'blockquote': return 'rich-editor-blockquote';
        default: return null;
    }
}

export default CommentsEditor;
