import React from 'react';

const List = (props) => {
    
    const renderRows = () => {
        const tasks = props.tasks || [];

        return tasks.map((task) => {
            return (
                <tr key={task.id}>
                    <td>{task.id}</td>
                    <td>{task.description}</td>
                    <td>
                        <button type="button" onClick={() => props.remove(task.id)} className="btn btn-sm btn-danger mr-2 text-white">
                            <i className="fa fa-trash"></i>
                        </button>
                        <button type="button" className="btn btn-sm btn-warning mr-2 text-white">
                            <i className="fa fa-edit"></i>
                        </button>
                        <button type="button" className="btn btn-sm btn-success mr-2 text-white">
                            <i className="fa fa-check"></i>
                        </button>
                    </td>
                </tr>
            );
        });
    }

    return (
        <div className="row mt-5">
            <div className="col-12">
                <table className="table table-sm">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Descrição</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        {renderRows()}
                    </tbody>
                </table>
            </div>
        </div>
    );
}

export default List;