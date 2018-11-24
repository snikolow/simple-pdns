import BaseDataTable from '../modules/BaseDataTable';

class Domain extends BaseDataTable {

    constructor() {
        super({
            dataTableSelector: 'table[data-role="domain-data-table"]',
            properties: {
                columns: [
                    {'data': 'id'},
                    {'data': 'name'},
                ],
                actionsCallback: function($table, data) {
                    let editPath = $table.data('edit-link-format').replace('__ID__', data.id);
                    let recordPath = $table.data('record-link-format').replace('__ID__', data.id);

                    return `
                        <a href="${editPath}" class="btn btn-sm btn-warning">
                            <i class="fa fa-pencil"></i>
                            Edit
                        </a>
                        <a href="${recordPath}" class="btn btn-sm btn-secondary">
                            <i class="fa fa-list"></i>
                            Records
                        </a>
                    `;
                }
            }
        });
    }

}

new Domain();
