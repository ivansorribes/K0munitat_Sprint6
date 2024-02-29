import React, { useState } from 'react';
import { AgGridReact } from 'ag-grid-react';
import 'ag-grid-community/styles/ag-grid.css';
import 'ag-grid-community/styles/ag-theme-alpine.css';

const AgGridTable = ({ rowData, columnDefs }) => {
    const [gridApi, setGridApi] = useState(null);
    const [gridColumnApi, setGridColumnApi] = useState(null);
    const [searchText, setSearchText] = useState('');

    const onGridReady = (params) => {
        setGridApi(params.api);
        setGridColumnApi(params.columnApi);
    };

    const onSearchTextChange = (event) => {
        setSearchText(event.target.value);
        gridApi.setQuickFilter(event.target.value);
    };

    return (
        <div className="p-4 border rounded-md">
            <div className="mb-4 flex items-center justify-end">
                <input
                    className="border p-2 mr-2 rounded"
                    type="text"
                    placeholder="Search..."
                    value={searchText}
                    onChange={onSearchTextChange}
                />
            </div>

            <div className="ag-theme-alpine" style={{ height: 400, width: '100%' }}>
                <AgGridReact
                    rowData={rowData}
                    columnDefs={columnDefs}
                    onGridReady={onGridReady}
                    domLayout='autoHeight'
                    defaultColDef={{
                        flex: 1,
                        minWidth: 150,
                    }}
                />
            </div>
        </div>
    );
};

if (document.getElementById("taula")) {
    createRoot(document.getElementById("taula")).render(<AgGridTable />);
}
export default AgGridTable;