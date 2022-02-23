<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
    <script type="text/babel">

        const SideMenuContext = React.createContext(null);

        const SideNav = () => {
            const {
                activeSideMenu, setActiveSideMenu, sideMenus
            } = React.useContext(SideMenuContext)

            return (
                <React.Fragment>
                    <div className={
                        "cursor-pointer box relative flex items-center p-5 " +
                        (activeSideMenu != null ? 'hidden' : '')
                    }>
                        <div className="ml-2 overflow-hidden">
                            <div className={"flex items-center font-bold"}>
                                Loading. . .
                            </div>
                        </div>
                    </div>

                    {
                        sideMenus.map((sideMenu) => {
                            return (
                                <React.Fragment key={sideMenu.id}>
                                    <div className="cursor-pointer box relative flex items-center p-5" onClick={() => {
                                        setActiveSideMenu(sideMenu);
                                    }}>
                                        <div className="ml-2 overflow-hidden">
                                            <div
                                                className={"flex items-center " + (activeSideMenu === sideMenu ? 'font-bold' : '')}>
                                                {
                                                    sideMenu.id == <?= session()->get('auth')['department_id'] ?> ?
                                                        'Receive Files' :
                                                        sideMenu.name
                                                }
                                            </div>
                                        </div>
                                    </div>
                                </React.Fragment>
                            );
                        })
                    }
                </React.Fragment>
            );
        }

        const Content = () => {
            const {
                activeSideMenu
            } = React.useContext(SideMenuContext)

            const [files, setFiles] = React.useState([]);

            const [isModalOpen, setModalOpen] = React.useState(false);
            const [fileToUpload, setFileToUpload] = React.useState(null);

            React.useEffect(() => {
                setFiles([]);
                if (activeSideMenu == null) {
                    return 0;
                }

                fetch('/files/getFiles/' + activeSideMenu.id)
                    .then(response => response.json())
                    .then((data) => {
                        setFiles(data);
                    });

            }, [activeSideMenu]);


            return (
                <React.Fragment>
                    <div className="flex items-center p-2 border-b border-slate-200/60">
                        <h2 className="font-medium text-base mr-auto">
                            {
                                activeSideMenu.id == <?= session()->get('auth')['department_id'] ?> ?
                                    'Receive Files' :
                                    'Shared Files to ' + activeSideMenu.name
                            }

                        </h2>
                        <button
                            className={ "button inline-block bg-green-500 text-white " +
                                (
                                    activeSideMenu.id==<?= session()->get('auth')['department_id'] ?> ?
                                        'hidden':''
                                )
                            }
                            onClick={() => {
                                setModalOpen(true);
                            }}
                        >
                            Upload
                        </button>
                    </div>
                    <div className="p-5" id="head-options-table">
                        <div className="preview block">
                            <div className="overflow-x-auto">
                                <table className="table">
                                    <thead className="table-dark bg-primary-900 text-white">
                                    <tr>
                                        <th className="whitespace-nowrap">ID</th>
                                        <th className="whitespace-nowrap">Name</th>
                                        <th className="whitespace-nowrap">File Size</th>
                                        <th className="whitespace-nowrap">Upload By</th>
                                        <th className="whitespace-nowrap">Upload Date</th>
                                        <th className="whitespace-nowrap">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    {
                                        files.length != 0 ?
                                            files.map((file) => {
                                                return (
                                                    <tr key={file.id}>
                                                        <td>{file.id}</td>
                                                        <td>{file.file_name}</td>
                                                        <td>{file.file_size}</td>
                                                        <td>
                                                            {
                                                                file.first_name + ' ' +
                                                                file.last_name + ' (' +
                                                                file.uploader_department_name + ')'
                                                            }
                                                        </td>
                                                        <td>{file.created_at}</td>
                                                        <td>{file.id}</td>
                                                    </tr>
                                                );
                                            })
                                            :
                                            <tr>
                                                <td colSpan="6" className="text-center">No Table Data</td>
                                            </tr>
                                    }
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div
                        id="new_form"
                        className={
                            isModalOpen ?
                                'absolute w-screen h-screen top-0 left-0 z-50' :
                                'hidden'
                        }
                        style={{
                            backgroundColor: 'rgba(45, 55, 72,.5)',
                            transition: 'visibility 0s linear 0s, opacity .2 0s'
                        }}
                    >
                        <div
                            className={"bg-white mx-auto mt-16 rounded"}
                            style={{width: '460px'}}
                        >

                            <div className="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                                <h2 className="font-medium text-base mr-auto">Upload a file</h2>
                            </div>
                            <div className="p-5 grid grid-cols-12 gap-4 row-gap-3">
                                <div className="col-span-12">
                                    <label>Select file to upload</label>
                                    <input
                                        type="file"
                                        name="file"
                                        className="input w-full border mt-2 flex-1"
                                        onChange={(event) => {
                                            console.log(event);
                                            setFileToUpload(event.target.files[0]);
                                        }}
                                    />
                                </div>
                            </div>
                            <div className="px-5 py-3 text-right border-t border-gray-200">
                                <button
                                    className="button w-20 border text-gray-700 mr-1"
                                    onClick={() => {
                                        setModalOpen(false);
                                        setFileToUpload(null);
                                    }}
                                >
                                    Cancel
                                </button>
                                <button
                                    className="button w-20 bg-green-500 text-white"
                                    onClick={async () => {
                                        if (fileToUpload == null) {
                                            toastr.error('Please select a file to upload!');
                                            return;
                                        }

                                        const formData = new FormData();
                                        formData.append("file", fileToUpload);
                                        formData.append("upload_to_department_id", activeSideMenu.id);
                                        try {
                                            const response = await axios({
                                                method: "post",
                                                url: "/files/upload",
                                                data: formData,
                                                headers: {"Content-Type": "multipart/form-data"},
                                            });
                                            if (response.data.success !== 0) {
                                                toastr.error(response.data.message);
                                            } else {
                                                //TODO: reload table and close form
                                            }
                                        } catch (error) {
                                            console.log(error)
                                        }
                                    }}
                                >
                                    Upload
                                </button>
                            </div>
                        </div>
                    </div>
                </React.Fragment>
            );
        }

        const App = () => {
            const [sideMenus, setSideMenus] = React.useState([]);
            const [activeSideMenu, setActiveSideMenu] = React.useState(null);

            React.useEffect(() => {
                fetch('/files/getOtherDepartments')
                    .then(response => response.json())
                    .then((data) => {
                        setSideMenus(data);
                        setActiveSideMenu(data[0]);
                    });
            }, []);


            return (
                <React.Fragment>
                    <SideMenuContext.Provider value={{activeSideMenu, setActiveSideMenu, sideMenus}}>
                        <div className="py-2">
                            <div className="text-lg font-bold">File Sharing</div>
                        </div>
                        <div className="flex flex-row gap-4">
                            <div className="w-1/4 flex flex-col gap-2">
                                <SideNav/>
                            </div>
                            <div className="bg-white rounded p-2 w-3/4">
                                {
                                    activeSideMenu == null ?
                                        (
                                            <div className="p-5 overflow-hidden">
                                                <div className={"flex items-center font-bold"}>
                                                    Loading. . .
                                                </div>
                                            </div>
                                        )
                                        :
                                        <Content/>
                                }
                            </div>
                        </div>
                    </SideMenuContext.Provider>
                </React.Fragment>
            );
        }

        ReactDOM.render(
            <App/>,
            document.getElementById('AppRoot')
        );

    </script>
<?= $this->endSection() ?>