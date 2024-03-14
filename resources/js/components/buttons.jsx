import React from 'react';

const ButtonEdit = ({ onClick, label }) => {

    return (
        <button className=" text-white px-4 py-2 rounded" style={{ background: '#62adde'}} onClick={onClick}>
            {label}
        </button>
    );
}

const ButtonCreate = ({ onClick, label }) => {
    return (
        <button className="text-white px-4 py-2 rounded" style={{ background: '#f4971e'}} onClick={onClick}>
            {label}
        </button>
    );
}

const ButtonDelete = ({ onClick, label }) => {
    return (
        <button className="text-white px-4 py-2 rounded" style={{ background: '#E51C1C'}} onClick={onClick}>
            {label}
        </button>
    );
}

const ButtonSave = ({ onClick, label }) => {
    return (
        <button className="text-white px-4 py-2 rounded" style={{ background: '#64a858'}} onClick={onClick}>
            {label}
        </button>
    );
}

const ButtonCancel = ({ onClick, label }) => {
    return (
        <button className="text-white px-4 py-2 rounded" style={{ background: '#3d3c3b'}} onClick={onClick}>
            {label}
        </button>
    );
}

const ButtonChangePage = ({ onClick, label }) => {
    return (
        <button className="text-white px-4 py-2 rounded" style={{ background: '#a03269'}} onClick={onClick}>
            {label}
        </button>
    );
}

const ButtonChangePassword = ({ onClick, label }) => {
    return (
        <button className="text-white px-4 py-2 rounded" style={{ background: '#af4f0a'}} onClick={onClick}>
            {label}
        </button>
    );
}
export { ButtonEdit, ButtonCreate, ButtonDelete, ButtonSave, ButtonCancel, ButtonChangePage, ButtonChangePassword };
