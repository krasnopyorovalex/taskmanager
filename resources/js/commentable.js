import ReactDOM from "react-dom";
import React from "react";

import ErrorBoundary from './components/error-boundary';
import Comments from "./components/comments";
import CommentsEditor from "./components/comments-editor";

import CommentsServiceApi from "./services/comments-service-api";
import ReplyToInfo from "./components/reply-to-info";
import {modifyCommentsArray} from "./utils/utils";
import Spinner from "./components/spinner";

class Commentable extends React.Component {

    commentsServiceApi = new CommentsServiceApi();

    state = {
        comments: null,
        clearEditor: false,
        replyTo: null,
        isLoading: true
    };

    componentDidMount() {
        const {getComments} = this.commentsServiceApi;
        const {task} = this.props;

        getComments(task).then(({data}) => {
            this.setState({
                comments: data,
                isLoading: false
            });
        });
    }

    saveComment = (commentBody) => {
        const {task} = this.props;
        const {saveComment} = this.commentsServiceApi;
        const {replyTo} = this.state;

        saveComment(task, commentBody, replyTo).then(({data}) => {
            this.setState({
                comments: [data, ...this.state.comments],
                clearEditor: true,
                replyTo: null
            });
        });
    };

    toggleClearEditor = () => {
        this.setState({
            clearEditor: ! this.state.clearEditor
        });
    };

    replyTo = (id) => {
        this.setState({
            replyTo: id
        });

        window.scrollTo({top: 1000, behavior: "smooth"});
    };

    render() {
        const {comments, replyTo, isLoading} = this.state;

        if (isLoading) {
            return <Spinner />;
        }

        return (
            <ErrorBoundary>
                <Comments comments={modifyCommentsArray(comments)} replyTo={this.replyTo} />
                { comments && replyTo && <ReplyToInfo comments={comments} replyTo={replyTo} /> }
                <CommentsEditor
                    clearEditor={this.state.clearEditor}
                    toggleClearEditor={this.toggleClearEditor}
                    saveComment={(text) => this.saveComment(text)}
                />
            </ErrorBoundary>
        );
    }
}

const el = document.getElementById('comments');

if (document.getElementById('comments')) {
    ReactDOM.render(<Commentable task={el.getAttribute('data-task')} />, el);
}
