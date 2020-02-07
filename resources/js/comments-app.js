import ReactDOM from "react-dom";
import React, {Fragment} from "react";

import Comments from "./components/comments";
import CommentsEditor from "./components/comments-editor";
import Button from "./components/button";

import CommentsServiceApi from "./services/comments-service-api";

class CommentsApp extends React.Component {

    commentsServiceApi = new CommentsServiceApi();

    state = {
        comment: null,
        commentBody: null,
        comments: null,
        clearEditor: false
    };

    componentDidMount() {
        const {getComments} = this.commentsServiceApi;
        const {task} = this.props;

        getComments(task).then(({data}) => {
            this.setState({
                comments: data
            });
        });
    }

    updateCommentBody = (text) => {
        this.setState({
            commentBody: text
        });
    };

    saveComment = () => {
        const {task} = this.props;
        const {saveComment} = this.commentsServiceApi;
        const {commentBody} = this.state;

        saveComment(task, commentBody).then(({data}) => {
            this.setState({
                comments: [data, ...this.state.comments],
                clearEditor: true
            });
        });
    };

    toggleClearEditor = () => {
        this.setState({
            clearEditor: ! this.state.clearEditor
        });
    };

    render() {
        const {comments} = this.state;

        return (
            <Fragment>
                <Comments comments={comments} />
                <CommentsEditor
                    clearEditor={this.state.clearEditor}
                    onChangedComment={(text) => this.updateCommentBody(text)}
                    toggleClearEditor={this.toggleClearEditor}
                />
                <Button label="Добавить комментарий" onEventSave={this.saveComment} />
            </Fragment>
        );
    }
}

const el = document.getElementById('comments');

if (document.getElementById('comments')) {
    ReactDOM.render(<CommentsApp task={el.getAttribute('data-task')} />, el);
}
