import { transformToEditor } from './editor';

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('textarea.simple-editor').forEach(function(item) {
        return newSimpleEditor(item);
    });
});

function newSimpleEditor(item) {
    const simpleEditor = document.createElement('div');
    item.parentNode.insertBefore(simpleEditor, item.nextSibling);
    transformToEditor(simpleEditor, item);

    simpleEditor.addEventListener('keyup', function () {
        return item.innerHTML = simpleEditor.innerHTML.replace('<br>', '');
    });
}
