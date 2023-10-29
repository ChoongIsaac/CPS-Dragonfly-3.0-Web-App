<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="css/iconcss/all.css">

<style>
    li{
        padding-top:0.7rem;
    }
    i{
        margin-right:0.3rem;
    }

</style>

</head>

<aside class="col-20 col-md-2 p-05 bg-dark flex-shrink-1">
    <nav class="navbar navbar-expand navbar-dark bg-dark flex-md-column flex-row align-items-start py-3">
        <div class="collapse navbar-collapse ">
            <ul class="flex-md-column flex-row navbar-nav w-100 justify-content-between">
                <li class="nav-item">
                    <a class="nav-link pl-0 text-nowrap" href="dashboard"><i class="fa fa-home fa-fw"></i> <span class="font-weight-bold">Dashboard</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-0" href="inventory"><i class="fa fa-box fa-fw"></i> <span class="d-none d-md-inline">Inventory</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-0" href="checkin"><i class="fa fa-dolly fa-fw"></i> <span class="d-none d-md-inline">Check In Items</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-0" href="scaninventory"><i class="fa fa-rss fa-fw"></i> <span class="d-none d-md-inline">Scan Inventory</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-0" href="checkout"><i class="fa fa-truck fa-fw"></i> <span class="d-none d-md-inline">Checked Out Items</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-0" href="#"><i class="fa fa-chart-pie fa-fw"></i> <span class="d-none d-md-inline">Reports</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-0" href="#"><i class="fa fa-map-marked-alt fa-fw"></i> <span class="d-none d-md-inline">Floor Plan</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-0" href="#"><i class="fa fa-users fa-fw"></i> <span class="d-none d-md-inline">Customers</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-0" href="#"><i class="fa fa-user fa-fw"></i> <span class="d-none d-md-inline">Profile</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-0" href="#"><i class="fa fa-users-cog fa-fw"></i> <span class="d-none d-md-inline">User Management</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-0" href="{{ route('logout') }}"><i class="fa fa-sign-out-alt fa-fw"></i> <span class="d-none d-md-inline">Logout</span></a>
                </li>
            </ul>
        </div>
    </nav>
</aside>
