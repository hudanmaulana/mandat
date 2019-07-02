(function (global, factory) {
  if (typeof define === "function" && define.amd) {
    define('/App/Work', ['exports', 'BaseApp'], factory);
  } else if (typeof exports !== "undefined") {
    factory(exports, require('BaseApp'));
  } else {
    var mod = {
      exports: {}
    };
    factory(mod.exports, global.BaseApp);
    global.AppWork = mod.exports;
  }
})(this, function (exports, _BaseApp2) {
  'use strict';

  Object.defineProperty(exports, "__esModule", {
    value: true
  });
  exports.getInstance = exports.run = exports.AppWork = undefined;

  var _BaseApp3 = babelHelpers.interopRequireDefault(_BaseApp2);

  var AppWork = function (_BaseApp) {
    babelHelpers.inherits(AppWork, _BaseApp);

    function AppWork() {
      babelHelpers.classCallCheck(this, AppWork);
      return babelHelpers.possibleConstructorReturn(this, (AppWork.__proto__ || Object.getPrototypeOf(AppWork)).apply(this, arguments));
    }

    babelHelpers.createClass(AppWork, [{
      key: 'initialize',
      value: function initialize() {
        babelHelpers.get(AppWork.prototype.__proto__ || Object.getPrototypeOf(AppWork.prototype), 'initialize', this).call(this);

        this.items = [];

        this.handleChart();

      }
    }, {
      key: 'process',
      value: function process() {
        babelHelpers.get(AppWork.prototype.__proto__ || Object.getPrototypeOf(AppWork.prototype), 'process', this).call(this);

        this.bindChart();
      }
    }, {
      key: 'handleChart',
      value: function handleChart() {
        /* create line chart */
        this.scoreChart = function (data) {
          var scoreChart = new Chartist.Line(data, {
            labels: ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'],
            series: [{
              name: 'series-1',
              data: [0.8, 1.5, 0.8, 2.7, 2.4, 3.9, 1.1]
            }, {
              name: 'series-2',
              data: [2.2, 3, 2.7, 3.6, 1.5, 1, 2.9]
            }, {
				name: 'series-3',
				data: [2.8, 3.8, 2.9, 3.1, 1.3, 1, 2.5]
			}]
          }, {
            lineSmooth: Chartist.Interpolation.simple({
              divisor: 100
            }),
            fullWidth: true,
            chartPadding: {
              right: 25
            },
            series: {
              'series-1': {
                showArea: false
              },
              'series-2': {
                showArea: false
              },
				'series-3': {
					showArea: false
				}
            },
            axisX: {
              showGrid: false
            },
            axisY: {
              scaleMinSpace: 40
            },
            plugins: [Chartist.plugins.tooltip()],
            low: 0,
            height: 250
          });
          scoreChart.on('draw', function (data) {
            if (data.type === 'point') {
              var parent = new Chartist.Svg(data.element._node.parentNode);
              parent.elem('line', {
                x1: data.x,
                y1: data.y,
                x2: data.x + 0.01,
                y2: data.y,
                class: 'ct-point-content'
              });
            }
          });
        };
      }
    }, {
      key: 'bindChart',
      value: function bindChart() {
        var _this2 = this;

        /* run chart */
        $(document).on('slidePanel::afterLoad', function () {
          _this2.scoreChart('.trends-chart');
        });
      }
    }]);
    return AppWork;
  }(_BaseApp3.default);

  var instance = null;

  function getInstance() {
    if (!instance) {
      instance = new AppWork();
    }
    return instance;
  }

  function run() {
    var app = getInstance();
    app.run();
  }

  exports.AppWork = AppWork;
  exports.run = run;
  exports.getInstance = getInstance;
  exports.default = AppWork;
});
