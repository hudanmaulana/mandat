(function (global, factory) {
	if (typeof define === "function" && define.amd) {
		define('/App/Taskboard', ['exports', 'Site'], factory);
	} else if (typeof exports !== "undefined") {
		factory(exports, require('Site'));
	} else {
		var mod = {
			exports: {}
		};
		factory(mod.exports, global.Site);
		global.AppTaskboard = mod.exports;
	}
})(this, function (exports, _Site2) {
	'use strict';

	Object.defineProperty(exports, "__esModule", {
		value: true
	});
	exports.getInstance = exports.run = exports.AppTaskboard = undefined;

	var _Site3 = babelHelpers.interopRequireDefault(_Site2);

	var dataTpl = function dataTpl() {
		var data = {
			status: false,
			title				: '',
			description			: '',
			priority			: 'normal',
			duedate				: '',
			members:[],
			subtasks: [],
			attachments: [],
			comments:[]

		};
		return data;
	};

	var StageList = function () {
		function StageList($el, data) {
			babelHelpers.classCallCheck(this, StageList);

			this.$el = $el;
			this.data = data;

			this.render();
			this.$el.sortable({
				handle: '.taskboard-stage-header'
			});
		}

		babelHelpers.createClass(StageList, [{
			key: 'add',
			value: function add() {
				var stage = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

				if (stage instanceof Stage) {
					this.$el.append(stage.$el);
				} else {
					this.add(this.createStage(stage));
				}
			}
		}, {
			key: 'createStage',
			value: function createStage(data) {
				return new Stage(data);
			}
		}, {
			key: 'render',
			value: function render() {
				var length = this.data.length;
				for (var i = 0; i < length; i++) {
					var stage = this.createStage(this.data[i]);

					this.add(stage);
				}
			}
		}]);
		return StageList;
	}();

	var Stage = function () {
		function Stage(data) {
			babelHelpers.classCallCheck(this, Stage);

			this.data = data;
			this.$el = null;
			this.$idgroup = null;
			this.$taskList = null;
			this.taskList = null;
			this.render();

			this.$stageDropdownArrow = $('.taskboard-stage-actions a[data-toggle="dropdown"]', this.$el);
			this.bindStageDropdownArrow();
			this.$renameBtn = $('.taskboard-stage-rename', this.$el);
			this.bindRenameBtn();
			this.$renameSaveBtn = $('.taskboard-stage-rename-save', this.$el);
			this.bindRenameSaveBtn();
			this.$deleteBtn = $('.taskboard-stage-delete', this.$el);
			this.bindDeleteBtn();
		}

		babelHelpers.createClass(Stage, [{
			key: 'render',
			value: function render() {
				this.$el = $(this.getTpl(this.data.title,this.data.id));
				this.$taskList = this.$el.find('.taskboard-list');
				var tasksData = this.data.tasks;
				this.taskList = new TaskList(this.$taskList, tasksData);
			}
		}, {
			key: 'getTpl',
			value: function getTpl(title,id) {

				return '\n' +
					'<li class="taskboard-stage">\n ' +
					'<header class="taskboard-stage-header">\n' +
					'<div class="taskboard-stage-actions float-right">\n' +
					'<div class="dropdown">\n' +
					'<a data-toggle="dropdown" href="#" aria-expanded="false"><i style="color:#fff!important" class="icon md-chevron-down" aria-hidden="true"></i></a>\n' +
					'<div class="dropdown-menu bullet" role="menu">\n' +
					'<a class="taskboard-stage-rename dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon md-edit" aria-hidden="true"></i>Rename</a>\n' +
					'<a class="taskboard-stage-delete dropdown-item" href="javascript:void(0)" data-idgroup="' + id + '" role="menuitem"><i class="icon md-delete" aria-hidden="true"></i>Delete</a>\n' +
					'<div class="taskboard-stage-rename-wrap">\n' +
					'<div class="form-group">\n' +
					'<input class="form-control taskboard-stage-rename-input-id" type="hidden" value="' + id + '" name="id">\n' +
					'<input class="form-control taskboard-stage-rename-input" type="text" value="' + title + '" name="name">\n' +
					'</div>\n' +
					'<button class="btn btn-primary btn-block taskboard-stage-rename-save"  type="button">Save</button>\n' +
					'</div>\n' +
					'</div>\n' +
					'</div>\n' +
					'</div>\n ' +
					'<h5 class="taskboard-stage-title">' + title + '</h5>\n' +
					'</header>\n' +
					'<div class="taskboard-stage-content">\n' +
					'<ul class="list-group taskboard-list"></ul>\n' +
					'<div class="action-wrap">\n' +
					'<a class="add-item-toggle" href="#"><i class="icon md-plus" aria-hidden="true"></i>Add Task</a>\n' +
					'<div class="add-item-wrap">\n' +
					' <form class="add-item" role="form" method="post" action="#">\n' +
					'<div class="form-group">\n ' +
					'<label class="form-control-label mb-15" for="name">Task name:</label>\n' +
					'<input class="form-control" type="text" placeholder="Task name" name="name">\n' +
					'<input class="form-control" type="hidden" placeholder="" value="'+id+'" name="id">\n' +
					'</div>\n' +
					'<div class="form-group text-right">\n ' +
					'<a class="btn btn-sm btn-white btn-pure add-item-cancel">Cancel</a>\n' +
					'<button type="button" class="btn btn-primary add-item-add">Add</button>\n' +
					'</div>\n' +
					'</form>\n' +
					'</div>\n' +
					'</div>\n' +
					'</div>\n' +
					'</li> \n';
			}
		}, {
			key: 'bindStageDropdownArrow',
			value: function bindStageDropdownArrow() {
				this.$stageDropdownArrow.on('click', function () {
					$(this).next('.dropdown-menu').removeClass('is-edit');
				});
			}
		}, {
			key: 'bindRenameBtn',
			value: function bindRenameBtn() {
				this.$renameBtn.on('click', function (e) {
					var $header = $(this).closest('.taskboard-stage-header'),
						$menu = $(this).closest('.dropdown-menu');

					var $input = $('.taskboard-stage-rename-input', $menu),
						$title = $('.taskboard-stage-title', $header);

					$menu.toggleClass('is-edit');
					$input.val('').focus().val($title.html());
					e.stopPropagation();
				});
			}
		}, {
			key: 'bindRenameSaveBtn',
			value: function bindRenameSaveBtn() {
				this.$renameSaveBtn.on('click', function () {
					var $header = $(this).closest('.taskboard-stage-header'),
						$input = $('.taskboard-stage-rename-input', $header),
						$inputid = $('.taskboard-stage-rename-input-id', $header),
						$title = $('.taskboard-stage-title', $header),
						value = $input.val();
					if (value.length === 0) {
						return;
					}
					$.ajax({
						type:"POST",
						url  :urltask+"/RenameSaveGroup",
						dataType : "JSON",
						data : {id_group:$inputid.val(),title_group:$input.val()},
					});
					$title.html(value);
				});
			}
		}, {
			key: 'bindDeleteBtn',
			value: function bindDeleteBtn() {
				this.$deleteBtn.on('click', function () {
					var $this = $(this);
					bootbox.confirm({
							message: "Do you want to delete the task?",
							buttons: {
								confirm: {
									label: 'Yes',
									className: 'btn-success'
								},
								cancel: {
									label: 'No',
									className: 'btn-danger'
								}
							},
						callback: function (result) {
							if(result){
								$.ajax({
									type:"POST",
									url  :urltask+"/BindDeleteGroup",
									dataType : "JSON",
									data : {idgroup:$this.data("idgroup")},
									success: function(data){
										console.log(data.status);
										if(data.status === false)
										{
											alertify.error(data.message);
										}
										else if (data.status === true)
										{
											alertify.success(data.message);
											$this.closest('.taskboard-stage').remove();
										}
									},
								});

							}
						}
					});
				});
			}
		}]);
		return Stage;
	}();

	var TaskList = function () {
		function TaskList($el, data) {
			babelHelpers.classCallCheck(this, TaskList);

			this.$el = $el;
			this.data = data;
			this.render();
			this.$el.sortable({
				connectWith: '.taskboard-stage .list-group'
			});

			this.$wrap = this.$el.parent().find('.action-wrap');
			this.$addItemToggle = this.$wrap.find('.add-item-toggle');
			this.bindAddItemToggle();
			this.$addItemBtn = this.$wrap.find('.add-item-add');
			this.bindAddItemBtn();
			this.$cancelBtn = this.$wrap.find('.add-item-cancel');
			this.bindCancelBtn();
			this.bindTaskInput();
			this.handleOpenSlidePanel();
		}

		babelHelpers.createClass(TaskList, [{
			key: 'add',
			value: function add() {
				var task = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

				if (task instanceof Task) {
					this.$el.append(task.$el);
				} else {
					var taskObj = this.createTask(task);
					taskObj.$el.data('taskInfo', task);
					this.add(taskObj);
				}
			}
		}, {
			key: 'createTask',
			value: function createTask(data) {
				return new Task(data);
			}
		}, {
			key: 'render',
			value: function render() {
				var length = this.data.length;
				if (length === 0) {
					return;
				}
				for (var i = 0; i < length; i++) {
					var task = this.createTask(this.data[i]);
					task.$el.data('taskInfo', this.data[i]);
					this.add(task);
				}
			}
		}, {
			key: 'bindAddItemToggle',
			value: function bindAddItemToggle() {
				var _this2 = this;

				this.$addItemToggle.on('click', function () {
					var $input = $('[name="name"]', _this2.$wrap);
					_this2.$wrap.toggleClass('action-open');
					$input.val('');
				});

				this.$wrap.on('click.add-item', '.form-control-label', function (e) {
					_this2.$wrap.removeClass('action-open');
					_this2.$el.off('click.add-item');
				});
			}
		}, {
			key: 'bindAddItemBtn',
			value: function bindAddItemBtn() {
				var _this3 = this;

				this.$addItemBtn.on('click', function () {
					var $input = $('[name="name"]', _this3.$wrap);
					var $id = $('[name="id"]', _this3.$wrap);
					var taskData = dataTpl();

					if ($input.val().length !== 0) {
						taskData.title = $input.val();
						$.ajax({
							type:"POST",
							url  :urltask+"/AddNewTaskTodo",
							dataType : "JSON",
							data : {id_group:$id.val(),title_task:$input.val()},
						});

						_this3.add(taskData);
					}

					_this3.$wrap.toggleClass('action-open');
				});
			}
		}, {
			key: 'bindCancelBtn',
			value: function bindCancelBtn() {
				var self = this;
				this.$cancelBtn.on('click', function () {
					self.$wrap.toggleClass('action-open');
				});
			}
		}, {
			key: 'bindTaskInput',
			value: function bindTaskInput() {
				this.$el.on("click", ".checkbox-custom input", function (e) {
					var $this = $(this);

					var $target = $this.closest('.list-group-item'),
						taskData = $target.data('taskInfo');

					taskData.complete = $this.prop('checked');
					$target.data('taskInfo', taskData);
					e.stopPropagation();
				});
			}
		}, {
			key: 'openSlidePanel',
			value: function openSlidePanel(jsonObj, showOptions) {
				if (typeof $.slidePanel === 'undefined') {
					return;
				}
				slidePanel.show(jsonObj, showOptions);
			}
		}, {
			key: 'handleOpenSlidePanel',
			value: function handleOpenSlidePanel() {
				var self = this;
				var options = $.extend({}, slidePanel.defaults, slidePanel.defaultsOptions);
				this.$el.on('click', '[data-taskboard="slidePanel"]', function (e) {
					var $target = $(e.target).closest('.list-group-item');
					var jsonData = {
						url: $(this).data('url'),
						target: $target
					};

					self.openSlidePanel(jsonData, options);
					e.stopPropagation();
				});
			}
		}]);
		return TaskList;
	}();

	var sildePaneldefaults = Plugin.getDefaults('slidePanel');
	var sildePaneldefaultsOptions = {
		template: function template(options) {
			return '\n          <div class="' + options.classes.base + '  ' + options.classes.base + '-' + options.direction + '">\n            <div class="' + options.classes.base + '-scrollable"><div>\n            <div class="' + options.classes.content + '"></div>\n            </div></div>\n            <div class="' + options.classes.base + '-handler"></div>\n          </div>\n          ';
		},
		afterLoad: function afterLoad(object) {
			var _this = this;
			var $target = $(object.target);
			var info = $target.data('taskInfo');

			this.$panel.find('.' + this.options.classes.base + '-scrollable').asScrollable({
				namespace: 'scrollable',
				contentSelector: '>',
				containerSelector: '>'
			});

			this.$panel.find('#task-description').markdown();
			if (typeof info !== 'undefined' && info.duedate.length > 0) {
				this.$panel.find('#taskDatepicker').data('date', info.duedate);
			}
			this.$panel.find('#taskDatepicker').datepicker({
				autoclose: false,
				setDate : new  Date(),
				todayHighlight: true
			}).on('changeDate', function () {
				$('#taskDatepickerInput').val(_this.$panel.find('#taskDatepicker').datepicker('getFormattedDate'));
			});

			this.$panel.data('slidePanel', object);

			$(document).off('click.slidePanelDatepicker');
			$(document).on('click.slidePanelDatepicker', 'span, td, th', function (e) {
				e.stopPropagation();
			});
		},
		afterShow: function afterShow() {
			var self = this;
			$(document).on('click.slidePanelShow', function (e) {
				if ($(e.target).closest('.slidePanel').length === 0 && $(e.target).closest('body').length === 1) {
					self.hide();
				}
			});
		},
		afterHide: function afterHide() {
			$(document).off('click.slidePanelShow');
			$(document).off('click.slidePanelDatepicker');
		},
		contentFilter: function contentFilter(data, object) {
			var $checked = undefined,
				$panel = $(data),
				$target = $(object.target);
			var info = $target.data('taskInfo');
			var $stage = $target.closest('.taskboard-stage');
			$('.stage-name', $panel).html($('.taskboard-stage-title', $stage.html()));

			$('.task-title', $panel).html(info.title);

			switch (info.priority) {
				case 'high':
					$checked = $('#priorityHigh', $panel);
					break;
				case 'urgent':
					$checked = $('#priorityUrgent', $panel);
					break;
				default:
					$checked = $('#priorityNormal', $panel);
					break;
				// no default
			}

			$checked.prop('checked', true);
			slidePanel.handleSelective($('[data-plugin="jquery-selective"]', $panel), info.members);
			// console.log(info.id);
			if (info.description.length === 0) {
				$('.description', $panel).addClass('is-empty');
			} else {
				$('.description-content', $panel).html(info.description);
			}

			if (info.subtasks.length !== 0) {
				var length = info.subtasks.length;
				for (var i = 0; i < length; i++) {
					var $subtask = $(slidePanel.subtaskTpl(info.subtasks[i]));
					$('.subtasks-list', $panel).append($subtask);
					// if (info.subtasks[i].id === "") {
					//
					// 	$('.subtasks', $panel).hide();
					// }
				}

				$('.subtasks', $panel).toggleClass('is-show');
			}

			if (info.attachments.length !== 0) {
				var _length = info.attachments.length;
				for (var _i = 0; _i < _length; _i++) {
					var $attachment = $(slidePanel.attachmentTpl(info.attachments[_i]));
					$('.attachments-list', $panel).append($attachment);
					if (info.attachments[_i].id === "") {
						// console.log(info.attachments[_i].id);
						$('.attachments-list', $panel).hide();
						$('.attachments', $panel).hide();
					}
				}
				$('.attachments', $panel).toggleClass('is-show');
			}

			if (info.comments.length !== 0) {
				var _length2 = info.comments.length;
				for (var _i2 = 0; _i2 < _length2; _i2++) {
					var $comment = $(slidePanel.commentTpl(info.comments[_i2].src, info.comments[_i2].user, info.comments[_i2].time, info.comments[_i2].content));
					$('.comments-history', $panel).append($comment);
					if (info.comments[_i2].id === "") {
						// console.log(info.comments[_i2].id);
						$('.comments-history', $panel).hide();
					}
				}
			}

			return $panel;
		}
	};

	var slidePanel = {
		defaults: sildePaneldefaults,
		defaultsOptions: sildePaneldefaultsOptions,

		handleSelective: function handleSelective($target, selected) {
			var getSelected = function getSelected() {
				var _this = this;

				var arr = [];
				$.each(this._options.getOptions(this), function (n, option) {
					$.each(_this.options.local, function (i, user) {
						if (user.id === $(option).val()) {
							arr.push(user);
						}
					});
				});
				return arr;
			};


			$.getJSON(urltask+'/get_member', function (data) {
				var members = 	JSON.parse(JSON.stringify(data));
				var uploadfile = Config.get('uploadfile');
				$target.selective({
					namespace: 'addMember',
					local: members,
					selected: selected,
					buildFromHtml: false,
					tpl: {
						optionValue: function optionValue(data) {
							return data.id;
						},
						frame: function frame() {
							return '<div class="' + this.namespace + '">\n            ' + this.options.tpl.items.call(this) + '\n            <div class="' + this.namespace + '-trigger">\n            ' + this.options.tpl.triggerButton.call(this) + '\n            <div class="' + this.namespace + '-trigger-dropdown">\n            ' + this.options.tpl.list.call(this) + '\n            </div>\n            </div>\n            </div>';
						},
						triggerButton: function triggerButton() {
							return '<div class="' + this.namespace + '-trigger-button"><i class="md-plus"></i></div>';
						},
						listItem: function listItem(data) {
							if(data.id === ''){
								return '';
							}
							else {
								return '<li class="' + this.namespace + '-list-item"><img  class="avatar" src="'+uploadfile+'' + data.img + '">' + data.name + '</li>';
							}

						},
						item: function item(data) {
							if(data.id === ''){
								return '';
							}
							else {
								return '<li class="' + this.namespace + '-item"><img class="avatar" src="'+uploadfile+'' + data.img + '">\n  <span data-iduser="'+data.id+'" data-idtask="'+data.id_task_todo+'" class="' + this.namespace + '-remove"><i class="icon md-minus-circle"></i></span> \n            </li>';
							}

						},
						itemRemove: function itemRemove() {
							return '<span  class="' + this.namespace + '-remove"><i class="icon md-minus-circle"></i></span>';
						},
						option: function option(data) {
							return '<option value="' + this.options.tpl.optionValue.call(this, data) + '">' + data.name + '</option>';
						}

					},

					onAfterItemAdd: function onAfterItemAdd() {
						var $target = this.$element.closest('.slidePanel').data('slidePanel').target;
						var arr = getSelected.call(this),
							taskData = $target.data('taskInfo');
						$target.data('taskInfo', taskData);
						var $memberList = $target.find('.task-members');
						var memberList = new MemberList($memberList, arr);
						var id_task_todo = taskData.id;
						$.ajax({
							type:"POST",
							url  :urltask+"/AddMember",
							dataType : "JSON",
							data : {id_task:taskData.members = arr,id_task_todo:id_task_todo},
						});
					},
					onAfterItemRemove: function onAfterItemRemove() {


						var $target = this.$element.closest('.slidePanel').data('slidePanel').target;
						var arr = getSelected.call(this),
							taskData = $target.data('taskInfo');
						taskData.members = arr;

						$target.data('taskInfo', taskData);
						var $memberList = $target.find('.task-members');
						var memberList = new MemberList($memberList, arr);

						$(document).on('click', '.addMember-remove', function () {
							var $this = $(this);

							console.log($this.data("iduser"));
							console.log($this.data("idtask"));
										$.ajax({
											type:"POST",
											url  :urltask+"/DeleteMember",
											dataType : "JSON",
											data : {iduser:$this.data("iduser"),idtask:$this.data("idtask")},
										});


						});
					}

				});

			});
			// var members = [{
			// 	id: '10',
			// 	name: 'Herman Beck',
			// 	img: 'portraits/1.jpg'
			// }, {
			// 	id: '11',
			// 	name: 'Mary Adams',
			// 	img: 'portraits/2.jpg'
			// }];
		},
		subtaskTpl: function subtaskTpl(data) {

			var checkedString = data.complete ? 'checked="checked"' : '';
			if (data.id === ""){

			} else {
				return '\n            <li class="list-group-item subtask">\n              ' +
					'<div class="checkbox-custom checkbox-primary">\n                ' +
					'<input type="checkbox" ' + checkedString + ' name="checkbox">\n                ' +
					'<label class="title">' + data.title+ '</label>\n              </div>\n              ' +
					'<div class="subtask-editor">\n                ' +
					'<form>\n                  ' +
					'<div class="form-group">\n                    ' +
					'<input class="form-control subtask-title" type="text" name="title">\n                  </div>\n                  ' +
					'<div class="form-group">\n                    <button class="btn btn-primary subtask-editor-save" type="button">Save</button>\n                    ' +
					'<a class="btn btn-sm btn-white subtask-editor-delete" data-idsubtask="' + data.id + '" href="javascript:void(0)">Delete</a>\n                  ' +
					'</div>\n                ' +
					'</form>\n              ' +
					'</div>\n            ' +
					'</li>\n           ';
			}

		},
		attachmentTpl: function attachmentTpl(data) {
			var taskdir = Config.get('taskdir');
			return '\n            <li class="list-group-item attachment">\n              ' +
				'<div class="meida">\n               ' +
				' <div class="pr-20">\n                  ' +
				'<div class="attachments-image">\n                    ' +
				'<img src="'+taskdir+''+ data.src + '">\n                  ' +
				'</div>\n                ' +
				'</div>\n                ' +
				'<div class="media-body">\n                  ' +
				'<p><span class="name">' + data.title + '</span><span</p>\n                  ' +
				'<p>\n                    <span class="size">' + data.size + '</span>\n                    ' +
				'<span class="attachments-actions">\n                      ' +
				'<a class="btn btn-icon btn-pure" href="'+taskdir+''+ data.src + '" download> <i class="icon md-download" aria-hidden="true"></i></a>\n' +
				'<a class="attachments-task-delete btn btn-icon btn-pure" data-idattachment="' + data.id + '" href="javascript:void(0)">\n                        ' +
				' <i class="icon md-delete" aria-hidden="true"></i>\n                      </a>\n                    </span>\n                  ' +
				'</p>\n                ' +
				'</div>\n              ' +
				'</div>\n            ' +
				'</li>\n           ';
		},
		commentTpl: function commentTpl(src, user, time, content) {
			return '\n            <div class="comment media">\n              <div class="pr-20">\n                <a class="avatar avatar-lg" href="javascript:void(0)">\n                  <img src="' + src + '" alt="...">\n                </a>\n              </div>\n              <div class="media-body">\n                <div class="comment-body">\n                  <a class="comment-author" href="javascript:void(0)">' + user + '</a>\n                  <div class="comment-meta">\n                    <span class="date">' + time + '</span>\n                  </div>\n                <div class="comment-content"><p>' + content + '</p></div>\n              </div>\n            </div>\n           ';
		},
		handlePriority: function handlePriority() {

			$(document).on('click', '[name="priorities"]', function () {
				var $this = $(this);
				var $target = $this.closest('.slidePanel').data('slidePanel').target;
				var taskData = $target.data('taskInfo');
				taskData.priority = $this.data('priority');
				$target.data('taskInfo', taskData);

				$.ajax({
					type:"POST",
					url  :urltask+"/ChangePriorityTask",
					dataType : "JSON",
					data : {id_task:taskData.id,priority:taskData.priority},
				});


				$target.removeClass('priority-normal priority-high priority-urgent').addClass('priority-' + $target.data('taskInfo').priority);
			});
		},
		handleDeleteTask: function handleDeleteTask() {
			$(document).on('click', '.taskboard-task-delete', function () {
				var $this = $(this);
				bootbox.dialog({
					message: 'Do you want to delete the task?',
					buttons: {
						success: {
							label: 'Delete',
							className: 'btn-danger',
							callback: function callback() {
								$this.closest('.slidePanel').data('slidePanel').target.remove();
								$('.slidePanel-close').trigger('click');
							}
						}
					}
				});
			});
		},
		handleEditor: function handleEditor() {
			$(document).on('click', '.slidePanel .task-title, .taskboard-task-edit, .description-toggle', function () {
				var $this = $(this);
				var $target = $this.closest('.slidePanel').data('slidePanel').target;
				var data = $target.data('taskInfo');

				$('#task-title').val(data.title);
				$('#task-description').val(data.description);
				$this.closest('.slidePanel').find('.task-main').addClass('is-edit');
			});

			$(document).on('click', '.task-main-editor-save', function () {
				var $this = $(this);
				var $target = $this.closest('.slidePanel').data('slidePanel').target;
				var taskData = $target.data('taskInfo');
				var idtasktodo =  taskData.id;
				taskData.title = $('#task-title').val();
				taskData.description = $('#task-description').val();

				$target.data('taskInfo', taskData);
				$('.task-title', $target).html($target.data('taskInfo').title);
				$('.slidePanel .task-title').html($target.data('taskInfo').title);

				$('.slidePanel .description-content').html($target.data('taskInfo').description);
				$.ajax({
					type:"POST",
					url  :urltask+"/UpdateDescriptionTask",
					dataType : "JSON",
					data : {idtasktodo:idtasktodo,tasktodotitle:taskData.title,tasktododesc:taskData.description},
				});

				$this.closest('.slidePanel').find('.task-main').removeClass('is-edit');
				if ($('#task-description').val().length === 0) {
					$('.description').addClass('is-empty');
				} else {
					$('.description').removeClass('is-empty');
				}
			});

			$(document).on('click', '.task-main-editor-cancel', function () {
				$(this).closest('.slidePanel').find('.task-main').removeClass('is-edit');
			});
		},
		handleSubtasks: function handleSubtasks() {
			var _this4 = this;

			var self = this;
			$(document).on('click', '.subtask-toggle', function () {
				var length = $('.subtask').length;
				var $input = $('.subtasks-add .subtask-title'),
					$subtasks = $('.subtasks');

				$input.val('');
				if (length === 0) {
					$subtasks.addClass('is-show');
				}
				$subtasks.addClass('is-edit');

				$input.focus();

				$(document).on('click.subtask-add', function (e) {
					var $target = $(e.target);
					if ($target.closest($('.subtasks-add')).length === 0) {
						$subtasks.removeClass('is-edit');
						$(document).off('click.subtask-add');
					}
				});
			});

			$(document).on('click', '.subtask-add-save', function () {
				var $input = $('.subtasks-add .subtask-title'),
					$subtasks = $('.subtasks'),
					$target = $(this).closest('.slidePanel').data('slidePanel').target;
				var length = $('.subtask').length,
					taskData = $target.data('taskInfo'),
					value = $input.val();

				if (value.length === 0) {
					if (length === 0) {
						$subtasks.removeClass('is-show');
					}
				} else {
					var data = {
						'title': value,
						'complete': false
					};
					var $subtask = $(self.subtaskTpl(data));
					$.ajax({
						type:"POST",
						url  :urltask+"/AddSubTask",
						dataType : "JSON",
						data : {id_task:taskData.id,title:value},
					});

					$('.subtasks-list').append($subtask);
					taskData.subtasks[length] = data;
					$target.data('taskInfo', taskData);
					var $badgeList = $target.find('.task-badges');
					var badgeList = new BadgeList($badgeList, $target.data('taskInfo'));
				}
				$input.val('').focus();
			});

			$(document).on('click', '.subtask-add-cancel', function () {
				$('.subtasks').removeClass('is-edit');
				$(document).off('click.subtask-add');
			});

			$(document).on('click', '.subtask input', function () {
				var $this = $(this);
				var $subtask = $this.closest('.subtask'),
					$target = $this.closest('.slidePanel').data('slidePanel').target;
				var index = $subtask.index(),
					taskData = $target.data('taskInfo');
				taskData.subtasks[index].complete = $this.prop('checked');
				$target.data('taskInfo', taskData);
				var $badgeList = $target.find('.task-badges');
				var badgeList = new BadgeList($badgeList, $target.data('taskInfo'));
			});

			$(document).on('click', '.subtask .title', function () {
				var $this = $(this);
				var $subtask = $this.closest('.subtask'),
					$target = $this.closest('.slidePanel').data('slidePanel').target;
				var data = $target.data('taskInfo'),
					index = $subtask.index();
				var $input = $('.subtask-title', $subtask);

				$subtask.addClass('is-edit');
				$input.val('').focus().val(data.subtasks[index].title);

				$(document).on('click.subtask', function (e) {
					var $target = $(e.target);
					if ($target.closest($subtask).length === 0) {
						$subtask.removeClass('is-edit');
						$(document).off('click.subtask');
					}
				});
			});

			$(document).on('click', '.subtask-editor-save', function () {
				var $this = $(this);
				var $subtask = $this.closest('.subtask'),
					$target = $this.closest('.slidePanel').data('slidePanel').target;

				var data = $target.data('taskInfo'),
					index = $subtask.index(),
					taskData = $target.data('taskInfo');

				taskData.subtasks[index].title = $('.subtask-title', $subtask).val();
				$target.data('taskInfo', taskData);
				$('.title', $('.subtasks-list .subtask')[index]).html($('.subtask-title', $subtask).val());
				$subtask.removeClass('is-edit');
				$(document).off('click.subtask');
			});

			$(document).on('click', '.subtask-editor-delete', function (e) {
				var $this = $(this);
				// var $this = $(_this4);
				bootbox.confirm({
					message: "Do you want to delete the subtask?",
					buttons: {
						confirm: {
							label: 'Yes',
							className: 'btn-success'
						},
						cancel: {
							label: 'No',
							className: 'btn-danger'
						}
					},
					callback: function (result) {
						if(result){
							$.ajax({
								type:"POST",
								url  :urltask+"/BindDeleteSubTask",
								dataType : "JSON",
								data : {idsubtask:$this.data("idsubtask")},
							});
							var $subtask = $this.closest('.subtask'),
								$target = $this.closest('.slidePanel').data('slidePanel').target;
							var data = $target.data('taskInfo'),
								index = $subtask.index(),
								taskData = $target.data('taskInfo');

							taskData.subtasks.splice(index, 1);
							$target.data('taskInfo', taskData);
							var $badgeList = $target.find('.task-badges');
							var badgeList = new BadgeList($badgeList, $target.data('taskInfo'));

							$subtask.remove();
							$(document).off('click.subtask');
							if ($('.subtask').length === 0) {
								$('.subtasks').removeClass('is-show');
							}
						}
					}
				});
			});
		},
		handleDatepicker: function handleDatepicker() {
			$(document).on('click', '.due-date-save', function () {
				var $this = $(this);
				var $target = $this.closest('.slidePanel').data('slidePanel').target;
				var taskData = $target.data('taskInfo'),
					value = $('#taskDatepickerInput').val();
				if (value.length > 0) {
					taskData.duedate = value;
					console.log(value);
					$target.data('taskInfo', taskData);
					$.ajax({
						type:"POST",
						url  :urltask+"/UpdateDuedateTask",
						dataType : "JSON",
						data : {idtasktodo:taskData.id,duedate:value},
					});

					var $badgeList = $target.find('.task-badges');
					var badgeList = new BadgeList($badgeList, $target.data('taskInfo'));
				}
			});

			$(document).on('click', '.due-date-delete', function () {
				var $this = $(this);
				var $target = $this.closest('.slidePanel').data('slidePanel').target;
				var taskData = $target.data('taskInfo');
				if (taskData.duedate.length === 0) {
					return;
				}
				taskData.duedate = '';
				$target.data('taskInfo', taskData);
				var $badgeList = $target.find('.task-badges');
				var badgeList = new BadgeList($badgeList, $target.data('taskInfo'));
				$('#taskDatepicker').datepicker('clearDates');
			});
		},
		handleAttachment: function handleAttachment() {
			var self = this;
			$(document).on('click', '#fileuploadToggle', function () {
				$('#fileupload').trigger('click');
				$("#fileupload").change(function(){
					var input = document.getElementById("fileupload");
					var file = input.files[0];
					var formData = new FormData();
					var $target = $(this).closest('.slidePanel').data('slidePanel').target;
					var length = $('.subtask').length, taskData = $target.data('taskInfo');
					formData.append("image", file);
					formData.append("id", taskData.id);
					$.ajax({
						url  :urltask+"/AddAttachment",
						type: "POST",
						data: formData,
						processData: false,
						contentType: false,
						success: function(data){
							alert('success');
						}
					});
					var data = {
						'src': 'dsadada',
						'title': 'dsadsa',
						'size' : '100'
					};
					var $subtask = $(self.attachmentTpl(data));

					$('.subtasks-list').append($subtask);
					taskData.attachments[length] = data;
					$target.data('taskInfo', taskData);
					var $badgeList = $target.find('.task-badges');
					var badgeList = new BadgeList($badgeList, $target.data('taskInfo'));
				});




			});
		},
		handleDeleteAttachment: function handleDeleteAttachment(){
			$(document).on('click', '.attachments-task-delete', function () {
				var $this = $(this);

				bootbox.confirm({
					message: "Do you want to delete the Attachments?",
					buttons: {
						confirm: {
							label: 'Yes',
							className: 'btn-success'
						},
						cancel: {
							label: 'No',
							className: 'btn-danger'
						}
					},
					callback: function (result) {
						if(result){
							$.ajax({
								type:"POST",
								url  :urltask+"/BindDeleteAttachment",
								dataType : "JSON",
								data : {idattachment:$this.data("idattachment")},
							});
							var $subtask = $this.closest('.attachment'),
								$target = $this.closest('.slidePanel').data('slidePanel').target;
							var data = $target.data('taskInfo'),
								index = $subtask.index(),
								taskData = $target.data('taskInfo');
							console.log($subtask.index());
							taskData.attachments.splice(index, 1);
							$target.data('taskInfo', taskData);
							var $badgeList = $target.find('.task-badges');
							var badgeList = new BadgeList($badgeList, $target.data('taskInfo'));

							$subtask.remove();
							$(document).off('click.attachment');
							if ($('.attachment').length === 0) {
								$('.attachments').removeClass('is-show');
							}
						}
					}
				});
			});
		},
		show: function show(jsonObj, showOptions) {
			$.slidePanel.show(jsonObj, showOptions);
		}
	};

	var Task = function () {
		function Task(data) {
			babelHelpers.classCallCheck(this, Task);

			this.$el = null;
			this.data = data;
			this.$taskBages = null;
			this.$taskMembers = null;
			this.badgeList = null;
			this.memberList = null;
			this.render(this.once);
		}

		babelHelpers.createClass(Task, [{
			key: 'render',
			value: function render() {
				this.$el = $(this.getTpl(this.data));
				this.$taskBages = this.$el.find('.task-badges');
				this.badgeList = new BadgeList(this.$taskBages, this.data);
				if (this.data.members.length > 0) {
					this.$taskMembers = this.$el.find('.task-members');
					this.memberList = new MemberList(this.$taskMembers, this.data.members);
				}
			}
		}, {
			key: 'getTpl',
			value: function getTpl(data) {
				// console.log(data);
				var uploadfile = Config.get('uploadfile');
				var checkedString = data.complete ? 'checked="checked"' : '';

				if(data.id === ""){
					return '';
				} else {
					if(data.img){
						return '\n            <li class="list-group-item priority-' + data.priority + '" data-taskboard="slidePanel" data-url="'+base_url+'rn-themes/defaultback/html/apps/taskboard/panel.tpl">\n                             <h4 class="task-title"><small>' + data.title + '</small></h4>\ \n              <div class="w-full">\n                <div class="task-badges"></div>\n                <ul class="task-members">\n                  <li><img class="avatar avatar-sm" src="'+uploadfile+''+data.img+'"></li>\n                </ul>\n              </div>\n            </li>\n           ';
					}

					else if (data.img ==="" ){
						return '\n            <li class="list-group-item priority-' + data.priority + '" data-taskboard="slidePanel" data-url="'+base_url+'rn-themes/defaultback/html/apps/taskboard/panel.tpl">\n                             <h4 class="task-title"><small>' + data.title + '</small></h4>\ \n              <div class="w-full">\n                <div class="task-badges"></div>\n                <ul class="task-members">\n                  <li></li>\n                </ul>\n              </div>\n            </li>\n           ';
					} else if ( typeof data.img === 'undefined'){
						return '\n            <li class="list-group-item priority-' + data.priority + '" data-taskboard="slidePanel" data-url="'+base_url+'rn-themes/defaultback/html/apps/taskboard/panel.tpl">\n                             <h4 class="task-title"><small>' + data.title + '</small></h4>\ \n              <div class="w-full">\n                <div class="task-badges"></div>\n                <ul class="task-members">\n                  <li></li>\n                </ul>\n              </div>\n            </li>\n           ';
					}
				}


			}
		}]);
		return Task;
	}();

	var BadgeList = function () {
		function BadgeList($el, data) {
			babelHelpers.classCallCheck(this, BadgeList);

			this.$el = $el;
			this.data = data;
			this.render();
		}

		babelHelpers.createClass(BadgeList, [{
			key: 'add',
			value: function add(badge) {
				this.$el.append(badge.$el);
			}
		}, {
			key: 'render',
			value: function render() {
				var _duedateData$subtasks = {
						duedateData: this.data.duedate,
						subtasksData: this.data.subtasks,
						attachmentsData: this.data.attachments,
						commentsData: this.data.comments
					},



					duedateData = _duedateData$subtasks.duedateData,
					subtasksData = _duedateData$subtasks.subtasksData,
					attachmentsData = _duedateData$subtasks.attachmentsData,
					commentsData = _duedateData$subtasks.commentsData;


				this.$el.children().remove();

				if (duedateData.length > 0) {
					var duedate = new Duedate(duedateData);
					this.add(duedate);
				}

				if (subtasksData.length > 0) {
					var subtasks = new Subtask(subtasksData);
					this.add(subtasks);
				}

				if (attachmentsData.length > 0) {
					var attachments = new Attachment(attachmentsData);
					this.add(attachments);
				}

				if (commentsData.length > 0) {
					var comments = new Comment(commentsData);
					this.add(comments);
				}
			}
		}]);
		return BadgeList;
	}();

	var Duedate = function () {
		function Duedate(data) {
			babelHelpers.classCallCheck(this, Duedate);

			this.data = data;
			this.$el = null;
			this.render();
		}

		babelHelpers.createClass(Duedate, [{
			key: 'render',
			value: function render() {
				this.$el = $(this.getTpl(this.data.split(/\//, 2).join('/')));
			}
		}, {
			key: 'getTpl',
			value: function getTpl(content) {


				if(content===""){
					return '';
				}
				else {
					return '<span class="task-badge task-badge-subtask icon md-calendar">' + content + '</span>';
				}

			}
		}]);
		return Duedate;
	}();

	var Subtask = function () {
		function Subtask(data) {
			babelHelpers.classCallCheck(this, Subtask);

			this.data = data;
			this.$el = null;
			this.render();
		}

		babelHelpers.createClass(Subtask, [{
			key: 'render',
			value: function render() {
				var thisid= this.data[0].id;
				var length = this.data.length;
				if (length > 0) {
					var num = 0;
					for (var i = 0; i < length; i++) {
						if (this.data[i].complete) {
							num++;
						}
					}
					this.$el = $(this.getTpl(num + '/' + length,thisid));
				}
			}
		}, {
			key: 'getTpl',
			value: function getTpl(content,thisid) {
				// console.log(content);
				if(thisid===""){
					return '<span class="task-badge task-badge-subtask icon md-format-list-bulleted">0</span>';
				}
				else {
					return '<span class="task-badge task-badge-subtask icon md-format-list-bulleted">' + content + '</span>';
				}

			}
		}]);
		return Subtask;
	}();

	var Attachment = function () {
		function Attachment(data) {
			babelHelpers.classCallCheck(this, Attachment);
			this.data = data;
			this.$el = null;
			this.render();
		}

		babelHelpers.createClass(Attachment, [{
			key: 'render',
			value: function render() {
				var thisid= this.data[0].id;

				var length = this.data.length;
				if (length > 0) {
					this.$el = $(this.getTpl(this.data.length,thisid));
				}
			}
		}, {
			key: 'getTpl',
			value: function getTpl(content,thisid) {
				if(thisid===""){
					return '<span class="task-badge task-badge-attachments icon md-attachment-alt">0</span>';
				}
				else {
					return '<span class="task-badge task-badge-attachments icon md-attachment-alt">' + content + '</span>';
				}
			}
		}]);
		return Attachment;
	}();

	var Comment = function () {
		function Comment(data) {
			babelHelpers.classCallCheck(this, Comment);

			this.data = data;
			this.$el = null;
			this.render();
		}

		babelHelpers.createClass(Comment, [{
			key: 'render',
			value: function render() {
				var thisid = this.data[0].id;
				var length = this.data.length;
				if (length > 0) {
					this.$el = $(this.getTpl(this.data.length,thisid));
				}
			}
		}, {
			key: 'getTpl',
			value: function getTpl(content,thisid) {
				if(thisid===""){
					return '<span class="task-badge task-badge-comments icon md-comment">0</span>';
				}
				else {
					return '<span class="task-badge task-badge-comments icon md-comment">' + content + '</span>';
				}

			}
		}]);
		return Comment;
	}();

	var MemberList = function () {
		function MemberList($el, data) {
			babelHelpers.classCallCheck(this, MemberList);

			this.$el = $el;
			this.data = data;
			this.render();
		}

		babelHelpers.createClass(MemberList, [{
			key: 'createMember',
			value: function createMember(data) {
				return new Member(data);
			}
		}, {
			key: 'add',
			value: function add() {
				var member = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

				if (member instanceof Member) {
					this.$el.append(member.$el);
				} else {
					var memberObj = this.createMember(member);
					this.add(memberObj);
				}
			}
		}, {
			key: 'render',
			value: function render() {
				this.$el.children().remove();
				if (this.data.length === 0) {
					return;
				}
				var length = this.data.length;

				for (var i = 0; i < length; i++) {
					this.add(this.data[i]);
				}
			}
		}]);
		return MemberList;
	}();

	var Member = function () {
		function Member(data) {
			babelHelpers.classCallCheck(this, Member);

			this.data = data;
			this.$el = null;
			this.render();
		}

		babelHelpers.createClass(Member, [{
			key: 'render',
			value: function render() {
				this.$el = $(this.getTpl(this.data.img));
			}
		}, {
			key: 'getTpl',
			value: function getTpl(src) {
				var uploadfile = Config.get('uploadfile');
				if(src ===""){
					return '';
				} else if (typeof  src === 'undefined'){
					return '';
				}else{
					return '<li><img class="avatar avatar-sm" src="'+uploadfile+'' + src + '"></li>';
				}

			}
		}]);
		return Member;
	}();

	var AppTaskboard = function (_Site) {
		babelHelpers.inherits(AppTaskboard, _Site);

		function AppTaskboard() {
			babelHelpers.classCallCheck(this, AppTaskboard);
			return babelHelpers.possibleConstructorReturn(this, (AppTaskboard.__proto__ || Object.getPrototypeOf(AppTaskboard)).apply(this, arguments));
		}

		babelHelpers.createClass(AppTaskboard, [{
			key: 'initialize',
			value: function initialize() {
				babelHelpers.get(AppTaskboard.prototype.__proto__ || Object.getPrototypeOf(AppTaskboard.prototype), 'initialize', this).call(this);

				this.$taskboard = $('#taskboardStages');
				this.stageList = null;
				this.createStageList();

				this.$floatBtn = $('.site-floataction');
				this.$model = $('#addStageFrom');
				this.$stageCreateBtn = this.$model.find('#taskboardStageCreat');
			}
		}, {
			key: 'process',
			value: function process() {
				babelHelpers.get(AppTaskboard.prototype.__proto__ || Object.getPrototypeOf(AppTaskboard.prototype), 'process', this).call(this);

				this.bindFloatBtn();
				this.bindStageCreateBtn();

				this.handleSlidePandelAction();
			}
		}, {
			key: 'createStageList',
			value: function createStageList() {
				var _this6 = this;

				var assets = Config.get('assets');


				$.getJSON(urltask+'/api', function (data) {
					_this6.stageList = new StageList(_this6.$taskboard, data);
				});
			}
		}, {
			key: 'bindFloatBtn',
			value: function bindFloatBtn() {
				var _this7 = this;

				this.$floatBtn.on('click', function () {
					$('input', _this7.$model).val('');
					$('option:first', $('select', _this7.$model)).prop('selected', 'selected');
				});
			}
		}, {
			key: 'bindStageCreateBtn',
			value: function bindStageCreateBtn() {
				var _this8 = this;

				this.$stageCreateBtn.on('click', function () {
					var $name = $('[name="name"]', _this8.$model);
					$.ajax({
						type:"POST",
						url  :urltask+"/AddGroupTodo",
						dataType : "JSON",
						data : {title_group:$name.val()},
					});

					var stageData = {
						title: $name.val(),
						tasks: []
					};
					setTimeout(function(){
						location.reload();
					}, 1);

					_this8.stageList.add(stageData);
				});
			}
		}, {
			key: 'handleSlidePandelAction',
			value: function handleSlidePandelAction() {
				slidePanel.handlePriority();
				slidePanel.handleSubtasks();
				slidePanel.handleDatepicker();
				slidePanel.handleEditor();
				slidePanel.handleDeleteTask();
				slidePanel.handleAttachment();
				slidePanel.handleDeleteAttachment();
			}
		}]);
		return AppTaskboard;
	}(_Site3.default);

	var instance = null;

	function getInstance() {
		if (!instance) {
			instance = new AppTaskboard();
		}

		return instance;
	}

	function run() {
		var app = getInstance();
		app.run();
	}

	exports.AppTaskboard = AppTaskboard;
	exports.run = run;
	exports.getInstance = getInstance;
	exports.default = AppTaskboard;
});



