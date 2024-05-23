declare global {
    function route(routeName?: string, parameters?: any[] | any, absolute?: boolean): string | function;
}

export {};
