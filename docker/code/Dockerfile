FROM ubuntu:vivid

MAINTAINER Cosmin Voicu <cosmin.voicu@gmail.com>

LABEL copyright="MIT"
LABEL description="Docker Image for Symfony."

RUN apt-get update && apt-get install --reinstall -y \
    locales \
	--no-install-recommends

#RUN localedef -i en_US -f UTF-8 en_US.UTF-8
#RUN update-locale LANG=en_US.UTF-8 LC_ALL=en_US.UTF-8
#ENV LANG en_US.UTF-8
#ENV LANGUAGE en_US:en
#ENV LC_ALL en_US.UTF-8

# set timezone
RUN dpkg-reconfigure --frontend noninteractive tzdata

# Installing base packages
RUN apt-get update && apt-get install -y \
	build-essential \
	wget \
	git \
	curl \
	vim \
	nano \
	acl \
	mc \
	htop \
	telnet \
	sysv-rc-conf \
	software-properties-common \
	python-software-properties \
    lynx \
    ncdu \
    mtr \
    grc \
    tmux \
    zsh \
    subversion \
	--no-install-recommends

VOLUME /var/www/symfony




