FROM nginx:alpine

RUN apk add --no-cache openssl bash

RUN mkdir -p /etc/nginx/ssl

COPY default.conf /etc/nginx/conf.d/default.conf

COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 80 443 5173

ENTRYPOINT ["/entrypoint.sh"]