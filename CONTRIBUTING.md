To ensure ease in contributing to this repository, we use two main branches.

The main branch should always be representative of the code on the production server. This should always be a stable release.

The deploy branch contains a version of the code which should be close to ready for production. From this branch, branches should be created to hold new features. Once the new features are complete, the branch should be merged into develop.

Once the next release is required, the develop branch will be merged into master via a release branch, with the possibility for multiple commits for small changes.

When the release is ready, it will be merged into the develop and master branch. Hotfixes may be applied to the master branch if required.
