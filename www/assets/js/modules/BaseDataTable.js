require('datatables');
require('datatables.net-bs4');

class BaseDataTable {

    constructor(options) {
        let defaultOptions = {
            $tableInstance: null,
            debug: true,
            dataTableSelector: 'table[data-role="data-table"]',
            properties: {}
        };

        // Extend module settings.
        this.settings = $.extend({}, defaultOptions, (options || {}));

        // Make sure that dataTable plugin is loaded.
        if (!this.assertDataTablesPresent()) {
            return;
        }

        // Make sure the target table exists in our DOM tree.
        if (!this.assertTableExists()) {
            return;
        }

        // Create the data table.
        this.initialize();
    }

    initialize() {
        let $table = this.settings.$tableInstance;
        let columns  = (typeof this.settings.properties.columns !== 'undefined')
            ? this.settings.properties.columns
            : [];

        // Checks whether the child class has provided an additional method that we are
        // going to use for the last table cell of each row - the Actions cell.
        // In there we render the action buttons for each row.
        if (typeof this.settings.properties.actionsCallback !== 'undefined') {
            let actionsCallback = this.settings.properties.actionsCallback;

            columns.push({
                data: null,
                className: 'text-center',
                render: function(data) {
                    return actionsCallback($table, data);
                }
            });
        }

        this.settings.$tableInstance.dataTable(
            {
                columns: columns,
                drawCallback: function() {
                    // Wrap the table in table-responsive class after the ajax request has been made.
                    // A bug in the Bootstrap responsive table causes the container to create a horizontal
                    // scroll after the page. Adding "width 100%" to the table solves the problem for now.
                    $table.wrap('<div class="table-responsive"></div>');
                }
            }
        );
    }

    assertDataTablesPresent() {
        if (typeof $.fn.dataTable === 'undefined') {
            this.debug('[DataTables] Plugin does not exists or not loaded!');

            return false;
        }

        return true;
    }

    assertTableExists() {
        if (typeof this.settings.dataTableSelector !== 'string') {
            this.debug('[DataTables] Invalid syntax for table selector!');

            return false;
        }

        this.settings.$tableInstance = $(document).find(this.settings.dataTableSelector);

        if (!this.settings.$tableInstance.length) {
            this.debug('[DataTables] Table not found!');

            return false;
        }

        return true;
    }


    debug(message) {
        if (this.settings.debug) {
            console.log(message);
        }
    }

}

export default BaseDataTable;