import BaseDataTable from '../modules/BaseDataTable';

class Record extends BaseDataTable {

    constructor() {
        super({
            dataTableSelector: 'table[data-role="record-data-table"]',
            properties: {
                columns: [
                    {'data': 'id'},
                    {'data': 'name'},
                    {'data': 'type'},
                    {'data': 'ttl'},
                    {'data': 'priority'},
                ],
                actionsCallback: function($table, data) {
                    let editPath = $table.data('edit-link-format')
                        .replace('__ID__', data.id)
                        .replace('__DOMAIN_ID__', data.domainId);

                    return `
                        <a href="${editPath}" class="btn btn-sm btn-warning">
                            <i class="fa fa-pencil"></i>
                            Edit
                        </a>
                    `;
                }
            }
        });
    }
}

new Record();
