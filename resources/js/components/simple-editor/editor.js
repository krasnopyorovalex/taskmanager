import { createToolbar } from './toolbar';
import { BEFORE_BEGIN } from './constants';

export const transformToEditor = (editor, textarea = null) => {
  // Indicate that the element is editable
  editor.setAttribute('contentEditable', true);

  // Add a custom class
  editor.className = '__editor';

  // Create an exec command function
  const execCommand = (commandId, value) => {
    document.execCommand(commandId, false, value);
    editor.focus();
  };

  // Set default paragraph to <p>
  execCommand('defaultParagraphSeparator', 'p');

  //Set text if exist
  if (textarea) {
    editor.innerHTML = textarea.innerText;
  }

  // Create a toolbar
  const toolbar = createToolbar(editor.dataset, execCommand);
  editor.insertAdjacentElement(BEFORE_BEGIN, toolbar);

  // Listen for events to detect where the caret is
  let isFormatBlockP = true;
  const updateActiveState = () => {
    const toolbarSelects = toolbar.querySelectorAll('select[data-command-id]');
    for (const select of toolbarSelects) {
      if (textarea) {
        textarea.innerHTML = editor.innerHTML.replace('<br>','');
      }
      if (editor.innerText.length && isFormatBlockP) {
        execCommand('formatblock', 'p');
        isFormatBlockP = false;
      }
    }

    const toolbarButtons = toolbar.querySelectorAll('button[data-command-id]');
    for (const button of toolbarButtons) {
      const active = document.queryCommandState(button.dataset.commandId);
      button.classList.toggle('active', active);
    }
  };
  editor.addEventListener('keydown', updateActiveState);
  editor.addEventListener('keyup', updateActiveState);
  editor.addEventListener('click', updateActiveState);
  toolbar.addEventListener('click', updateActiveState);
};
