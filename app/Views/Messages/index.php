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
                        (sideMenus.length === 0 ? '' : 'hidden')
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
                                                {sideMenu.name}
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
                activeSideMenu, setActiveSideMenu
            } = React.useContext(SideMenuContext)


            return (
                <React.Fragment>
                    <div className="font-medium text-base p-4">
                        {activeSideMenu.name} Messages
                    </div>

                    <div className="border-b border-slate-200/60"/>
                    <div className="p-2" style={{height: 'calc(100vh - 328px)'}}>
                        <div className="flex items-end float-left mb-4">
                            <div className="bg-gray-300 px-4 py-3 text-slate-500 rounded-r-md rounded-t-md">
                                <div className="font-bold">Boom</div>
                                Lorem ipsum sit amen dolor, lorem ipsum sit amen dolor
                                <div className="mt-1 text-xs text-slate-500">10 secs ago</div>
                            </div>
                        </div>

                        <div className="clear-both"/>

                        <div className="flex items-end float-right mb-4">
                            <div className="bg-blue-500 px-4 py-3 text-white rounded-l-md rounded-t-md">
                                Lorem ipsum
                                <div className="mt-1 text-xs text-white text-opacity-80">1 secs ago</div>
                            </div>
                        </div>

                    </div>
                    <div className="border-b border-slate-200/60"/>


                    <div className="flex flex-row">
                        <div className="w-full">
                            <input
                                className="w-full border-transparent px-5 py-3 shadow-none focus:outline-0 focus:border-transparent focus:ring-0"
                                placeholder="Type your message..."
                                style={{border: 0}}
                            />
                        </div>
                        <div className="bg-primary-500 flex flex-row justify-center px-4">
                            <button
                                className="text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" strokeWidth="1.5" strokeLinecap="round"
                                     strokeLinejoin="round" className="feather feather-send w-4 h-4">
                                    <line x1="22" y1="2" x2="11" y2="13"/>
                                    <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </React.Fragment>
            );
        }

        const App = () => {
            const [sideMenus, setSideMenus] = React.useState([]);
            const [activeSideMenu, setActiveSideMenu] = React.useState(null);

            React.useEffect(() => {
                fetch('/messages/getOtherDepartments')
                    .then(response => response.json())
                    .then((data) => {
                        setSideMenus(data);
                    });
            }, []);


            return (
                <React.Fragment>
                    <SideMenuContext.Provider value={{activeSideMenu, setActiveSideMenu, sideMenus}}>
                        <div className="py-2">
                            <div className="text-lg font-bold">Messages</div>
                        </div>
                        <div className="flex flex-col">
                            <div className="flex flex-row grow gap-4">
                                <div className="w-1/4 flex flex-col gap-2">
                                    <SideNav/>
                                </div>
                                <div className="bg-white rounded w-3/4">
                                    {
                                        sideMenus.length === 0 ?
                                            <div className="p-5 overflow-hidden">
                                                <div className={"flex items-center font-bold"}>
                                                    Loading. . .
                                                </div>
                                            </div>
                                            :
                                            activeSideMenu == null ?
                                                <div className="h-full flex flex-col">
                                                    <div className="text-center my-auto">
                                                        <div className="font-medium">
                                                            Hey,
                                                            <?= session()->get('auth')['first_name'] ?>
                                                            <?= session()->get('auth')['last_name'] ?>
                                                            !
                                                        </div>
                                                        <div className="text-slate-500 mt-1">
                                                            Please select a chat to start messaging.
                                                        </div>
                                                    </div>
                                                </div>
                                                :
                                                <Content/>
                                    }
                                </div>
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