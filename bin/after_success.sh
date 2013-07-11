#!/usr/bin/env bash
cd "$(dirname "$0")/.."

have() { command -v "$1" >/dev/null 2>&1; }

if [[ "$TRAVIS" == "true" ]]; then
  if [[ "$TRAVIS_PULL_REQUEST" == "true" ]]; then
    echo "This is a pull request. No deployment will be done."
    exit 0
  fi
  if [[ "$TRAVIS_BRANCH" != "master" ]]; then
    echo "Testing on a branch other than master. No deployment will be done."
    exit 0
  fi

  gem install pagoda
fi

if ! have pagoda; then
  echo "The Pagoda gem file is not installed. Please install it."
  exit 1
fi

git remote add pagoda git@git.pagodabox.com:archive-my-tweets-wysow-fr.git

echo "Host pagoda.com" >> ~/.ssh/config
echo "  StrictHostKeyChecking no" >> ~/.ssh/config
echo "  CheckHostIP no" >> ~/.ssh/config
echo "  UserKnownHostsFile=/dev/null" >> ~/.ssh/config

branch="$(git symbolic-ref HEAD 2>/dev/null)"
branch="${branch#refs/heads/}"

mkdir -p ~/.ssh
ssh-keygen -t rsa -N "" -f ~/.ssh/id_rsa -C "travis-deployment"

yes | pagoda key:push
yes | git push pagoda $branch
