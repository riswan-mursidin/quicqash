            <div class="dropdown d-inline-block user-dropdown">
              <button
                type="button"
                class="btn header-item waves-effect"
                id="page-header-user-dropdown"
                data-bs-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <img
                  class="rounded-circle header-profile-user"
                  src="assets/images/logo-sm.png"
                  alt="Header Avatar"
                />
                <span class="d-none d-xl-inline-block ms-1"><?= ucfirst($username) ?></span>
                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end">
                <!-- item-->
                <a class="dropdown-item" href="profile-user"
                  ><i class="ri-user-line align-middle me-1"></i> Profile</a
                >
                <a class="dropdown-item" href="password-user"
                  ><i class="ri-key-2-line align-middle me-1"></i> Change
                  Password</a
                >

                <a class="dropdown-item" href="pin-user"
                  ><i class="ri-lock-unlock-line align-middle me-1"></i> Change
                  Pin</a
                >
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-danger" href="logout"
                  ><i
                    class="ri-shut-down-line align-middle me-1 text-danger"
                  ></i>
                  Logout</a
                >
              </div>
            </div>