FROM ghcr.io/unb-libraries/nginx:3.18.x

ENV APP_HOSTNAME="acts.lib.unb.ca"

COPY ./html/ ${APP_WEBROOT}/

LABEL ca.unb.lib.generator="nginx" \
  com.microscaling.license="MIT" \
  org.label-schema.build-date=$BUILD_DATE \
  org.label-schema.description="acts.lib.unb.ca coming-soon static page" \
  org.label-schema.name="acts.lib.unb.ca" \
  org.label-schema.schema-version="1.0" \
  org.label-schema.url="https://acts.lib.unb.ca" \
  org.label-schema.vcs-ref=$VCS_REF \
  org.label-schema.vcs-url="https://github.com/unb-libraries/acts.lib.unb.ca" \
  org.label-schema.vendor="University of New Brunswick Libraries" \
  org.label-schema.version=$VERSION \
  org.opencontainers.image.authors="UNB Libraries <libsupport@unb.ca>" \
  org.opencontainers.image.source="https://github.com/unb-libraries/acts.lib.unb.ca"
