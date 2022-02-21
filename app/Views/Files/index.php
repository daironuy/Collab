<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>
    <!--    <div class="py-2">-->
    <!--        <div class="text-lg font-bold">File Sharing</div>-->
    <!--    </div>-->
    <!--    <div class="flex flex-row gap-4">-->
    <!--        <div class="w-1/4 flex flex-col gap-2">-->
    <!--            <div class="cursor-pointer box relative flex items-center p-5">-->
    <!--                <div class="ml-2 overflow-hidden">-->
    <!--                    <div class="flex items-center font-bold">-->
    <!--                        Files Receive-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!---->
    <!--            <div class="cursor-pointer box relative flex items-center p-5">-->
    <!--                <div class="ml-2 overflow-hidden">-->
    <!--                    <div class="flex items-center font-normal">-->
    <!--                        Send Files to CSS-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--        <div class="bg-blue-300 rounded p-2 w-3/4">-->
    <!--            Content dito-->
    <!--        </div>-->
    <!--    </div>-->
<?= $this->endSection() ?>

<?= $this->section('script') ?>
    <script type="text/babel">

        const SideNav = () => {
            const sideMenus = [
                'Files Receive',
                'Send Files to CSS',
                'Send Files to Archi',
            ];

            const [activeSideMenu, setActiveSideMenu] = React.useState(sideMenus[0]);

            return (
                <React.Fragment>
                    {
                        sideMenus.map((sideMenu) => {
                            return (
                                <React.Fragment key={sideMenu}>
                                    <div className="cursor-pointer box relative flex items-center p-5" onClick={()=>{
                                        setActiveSideMenu(sideMenu);
                                    }}>
                                        <div className="ml-2 overflow-hidden">
                                            <div
                                                className={"flex items-center " + (activeSideMenu === sideMenu ? 'font-bold' : '')}>
                                                {sideMenu}
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

        const App = () => {
            return (
                <React.Fragment>
                    <div className="py-2">
                        <div className="text-lg font-bold">File Sharing</div>
                    </div>
                    <div className="flex flex-row gap-4">
                        <div className="w-1/4 flex flex-col gap-2">
                            <SideNav/>
                        </div>
                        <div className="bg-blue-300 rounded p-2 w-3/4">
                            Content dito
                        </div>
                    </div>
                </React.Fragment>
            );
        }

        ReactDOM.render(
            <App/>,
            document.getElementById('AppRoot')
        );

    </script>
<?= $this->endSection() ?>