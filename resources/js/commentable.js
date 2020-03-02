import ReactDOM from "react-dom";
import React from "react";

import ErrorBoundary from './components/error-boundary';
import Comments from "./components/comments";
import CommentsEditor from "./components/comments-editor";

import CommentsServiceApi from "./services/comments-service-api";
import ReplyToInfo from "./components/reply-to-info";
import {modifyCommentsArray, notify} from "./utils/utils";
import Spinner from "./components/spinner";

class Commentable extends React.Component {

    commentsServiceApi = new CommentsServiceApi();

    state = {
        comments: null,
        clearEditor: false,
        replyTo: null,
        isLoading: true,
        inProcess: false
    };

    componentDidMount() {
        const {getComments} = this.commentsServiceApi;
        const {url} = this.props;

        getComments(url).then(({data}) => {
            this.setState({
                comments: data,
                isLoading: false
            });
        });
    }

    saveComment = (commentBody) => {
        this.setState({
            inProcess: true
        });

        const {url} = this.props;
        const {saveComment} = this.commentsServiceApi;
        const {replyTo, inProcess} = this.state;

        if (!inProcess) {
            saveComment(url, commentBody, replyTo).then(({data}) => {
                this.setState({
                    comments: [data, ...this.state.comments],
                    clearEditor: true,
                    replyTo: null,
                    inProcess: false
                });
            }).catch(({response}) => {
                this.setState({inProcess: false});
                return response ? notify(response.data.message) : false;
            });
        }
    };

    toggleClearEditor = () => {
        this.setState({
            clearEditor: ! this.state.clearEditor
        });
    };

    clearReply = () => {
        this.setState({replyTo: null});
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
                { comments && replyTo && <ReplyToInfo comments={comments} replyTo={replyTo} clearReply={this.clearReply} /> }
                <CommentsEditor
                    clearEditor={this.state.clearEditor}
                    toggleClearEditor={this.toggleClearEditor}
                    saveComment={(text) => this.saveComment(text)}
                    status={this.props.status}
                />
            </ErrorBoundary>
        );
    }
}

const el = document.getElementById('comments');

if (document.getElementById('comments')) {
    ReactDOM.render(<Commentable url={el.getAttribute('data-url')} status={el.getAttribute('data-status')} />, el);
}
