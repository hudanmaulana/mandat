<header class="slidePanel-header">
  <div class="overlay-top overlay-panel overlay-background bg-light-green-600">
    <div class="slidePanel-actions btn-group btn-group-flat" aria-label="actions" role="group">
      <div class="dropdown float-left">
        <button type="button" class="btn btn-pure icon md-calendar" data-toggle="dropdown"
          aria-hidden="true"></button>
        <div class="dropdown-menu dropdown-menu-right bullet taskboard-task-datepicker">
          <div id="taskDatepicker"></div>
          <input type="hidden" id="taskDatepickerInput" />
          <div class="p-10">
            <button class="btn btn-primary due-date-save">Save</button>
            <a class="btn btn-sm btn-white due-date-delete" href="javascript:void(0)">Delete</a>
          </div>
        </div>
      </div>
      <button type="button" class="btn btn-pure icon md-format-list-bulleted subtask-toggle"
        aria-hidden="true"></button>
      <div class="fileupload float-left">
        <button id="fileuploadToggle" type="button" class="btn btn-pure icon md-attachment-alt"
          aria-hidden="true"></button>
        <input id="fileupload" type="file" name="upload">
      </div>
      <div class="dropdown float-left">
        <button type="button" class="btn btn-pure icon md-chevron-down" data-toggle="dropdown"
          aria-hidden="true"></button>
        <div class="dropdown-menu dropdown-menu-right bullet" role="menu">
          <a class="taskboard-task-edit dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon md-edit" aria-hidden="true"></i>Edit Task</a>
          <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon md-delete" aria-hidden="true"></i>Delete Task</a>
        </div>
      </div>
      <button type="button" class="btn btn-pure slidePanel-close icon md-close" aria-hidden="true"></button>
    </div>
    <h4 class="stage-name"></h4>
  </div>
</header>
<div class="slidePanel-inner">
  <section class="slidePanel-inner-section">
    <div class="task-main">
      <div class="task-main-surface">
        <div class="priority float-right">
          <label class="mr-20">Priority:</label>
          <ul class="list-unstyled list-inline inline-block">
            <li class="radio-custom radio-normal list-inline-item">
              <input type="radio" class="icheckbox-grey" id="priorityNormal" data-priority="normal"
                name="priorities">
              <label for="priorityNormal">Normal</label>
            </li>
            <li class="radio-custom radio-high list-inline-item">
              <input type="radio" class="icheckbox-grey" id="priorityHigh" data-priority="high"
                name="priorities">
              <label for="priorityHigh">High</label>
            </li>
            <li class="radio-custom radio-urgent list-inline-item">
              <input type="radio" class="icheckbox-grey" id="priorityUrgent" data-priority="urgent"
                name="priorities">
              <label for="priorityUrgent">Urgent</label>
            </li>
          </ul>
        </div>
        <div class="caption task-title"></div>
        <div class="add-members">
          <select multiple="multiple" data-plugin="jquery-selective"></select>
        </div>

        <div class="description">
          <p class="description-content"></p>
          <a href="#" class="description-toggle">Add description.</a>
        </div>
      </div>
      <div class="task-main-editor">
        <form>
          <div class="form-group">
            <input id="task-title" class="form-control" type="text" name="title">
          </div>
          <div class="form-group">


			  <textarea class="form-control" id="task-description" placeholder="description"    name="content" rows="3"></textarea>
          </div>
          <div class="form-group">
            <button class="btn btn-primary task-main-editor-save" type="button">Save</button>
            <a class="btn btn-sm btn-white task-main-editor-cancel" href="javascript:void(0)">Cancel</a>
          </div>
        </form>
      </div>
    </div>
    <div class="task-section subtasks">
      <label><i class="icon md-format-list-bulleted mr-10"></i>Subtasks</label>
      <ul class="list-group list-group-full subtasks-list"></ul>
      <div class="subtasks-add">
        <form>
          <div class="form-group">
            <input class="form-control subtask-title" type="text" name="title">
          </div>
          <div class="form-group">
            <button class="btn btn-primary subtask-add-save" type="button">Save</button>
            <a class="btn btn-sm btn-white subtask-add-cancel" href="javascript:void(0)">Cancel</a>
          </div>
        </form>
      </div>
    </div>
    <div class="task-section attachments">
      <label><i class="icon md-attachment-alt mr-10"></i>Attachments

	  </label>
      <ul class="list-group attachments-list"></ul>
    </div>
  </section>
</div>
